<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation;

use type Facebook\HHAPIDoc\Documentable;
use type Facebook\DefinitionFinder\{
  AbstractnessToken,
  FinalityToken,
  ScannedClass,
  ScannedClassish,
  ScannedConstant,
  ScannedDefinition,
  ScannedFunction,
  ScannedGeneric,
  ScannedInterface,
  ScannedMethod,
  ScannedNewtype,
  ScannedParameter,
  ScannedProperty,
  ScannedTrait,
  ScannedType,
  ScannedTypehint,
  StaticityToken,
  VarianceToken,
  VisibilityToken,
};

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Dict, Keyset, Math, Str, Vec};

final class DataMerger {
  private static function normalizeNameForMerge(string $name): string {
    return $name
      |> Str\strip_prefix($$, "HH\\Lib\\Experimental\\")
      |> Str\strip_prefix($$, "HH\\Lib\\")
      |> Str\strip_prefix($$, "HH\\");
  }

  public static function mergeAll(vec<Documentable> $in): vec<Documentable> {
    /* We start by throwing any documentables with parents (e.g. methods
     * have a class as a parent), as we need to de-dupe the parents first;
     * the children are de-duped as part of that process, so we can extract
     * them from the parents after */
    $top_level = $in
      |> Vec\filter(
        $$,
        $d ==> $d['parent'] === null &&
          !(
            $d['definition'] is ScannedType ||
            $d['definition'] is ScannedNewtype
          ),
      )
      |> Dict\group_by($$, $item ==> self::getMergeKey($item))
      |> Vec\map(
        $$,
        $items ==> {
          $first = C\firstx($items);
          $rest = Vec\drop($items, 1);
          if (C\is_empty($rest)) {
            return $first;
          }
          $merged = $first;
          foreach ($rest as $item) {
            $merged = self::mergePair($merged, $item);
          }
          return $merged;
        },
      );

    $methods = $top_level
      |> Vec\map(
        $$,
        $parent ==> {
          $def = $parent['definition'];
          if ($def is ScannedClassish) {
            // Type refinement
            $parent['definition'] = $def;
            return $parent;
          }
          return null;
        },
      )
      |> Vec\filter_nulls($$)
      |> Vec\map(
        $$,
        $parent ==> Vec\map(
          $parent['definition']->getMethods(),
          $method ==> shape(
            'definition' => $method,
            'parent' => $parent['definition'],
            'sources' => $parent['sources'],
          ),
        ),
      )
      |> Vec\flatten($$);
    return Vec\concat($top_level, $methods)
      |> Vec\sort_by($$, $d ==> $d['definition']->getName());
  }

  private static function mergePair(
    Documentable $a,
    ?Documentable $b,
  ): Documentable {
    if ($b === null) {
      return $a;
    }

    $parent = $a['parent'];
    if ($parent) {
      $parent = self::mergeDefinitionPair($parent, $b['parent'])
        as ScannedClassish;
    } else {
      $parent = $b['parent'];
    }

    $def = self::mergeDefinitionPair($a['definition'], $b['definition']);
    return shape(
      'parent' => $parent,
      'sources' => vec(Keyset\union($a['sources'], $b['sources'])),
      'definition' => $def,
    );
  }

  private static function mergeDefinitionPair<T as ScannedDefinition>(
    T $a,
    ?T $b,
  ): ScannedDefinition {
    if ($b === null) {
      return $a;
    }

    if ($a is ScannedClassish) {
      return self::mergeClassishPair($a, $b);
    }

    if ($a is ScannedFunction) {
      return self::mergeFunctionPair($a, $b);
    }

    if ($a is ScannedMethod) {
      return self::mergeMethodPair($a, $b);
    }

    if ($a is ScannedConstant) {
      return self::mergeConstantPair($a, $b);
    }

    if ($a is ScannedProperty) {
      return self::mergePropertyPair($a, $b);
    }

    invariant_violation('Unhandled type %s', \get_class($a));
  }

  private static function mergePropertyPair(
    ScannedProperty $a,
    ScannedDefinition $b,
  ): ScannedProperty {
    assert($b is ScannedProperty);

    invariant(
      $a->isStatic() === $b->isStatic(),
      'Property %s has both static and non-static definitions',
      $a->getName(),
    );

    $visibility = VisibilityToken::T_PUBLIC;
    if ($a->isPrivate() || $b->isPrivate()) {
      $visibility = VisibilityToken::T_PRIVATE;
    } else if ($a->isProtected() || $b->isProtected()) {
      $visibility = VisibilityToken::T_PROTECTED;
    }

    return new ScannedProperty(
      $a->getASTx(),
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeTypehintPair($a->getTypehint(), $b->getTypehint()),
      $visibility,
      $a->isStatic() ? StaticityToken::IS_STATIC : StaticityToken::NOT_STATIC,
      $a->getDefault() ?? $b->getDefault(),
    );
  }

  private static function mergeConstantPair(
    ScannedConstant $a,
    ScannedDefinition $b,
  ): ScannedConstant {
    assert($b is ScannedConstant);

    $value = $a->getValue();
    if ($value->hasStaticValue()) {
      $v = $value->getStaticValue();
      if ($v === null || $v === '' || $v === 0 || $v === 0.0) {
        $value = $b->getValue();
      }
    }

    return new ScannedConstant(
      $a->getASTx(),
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      $value,
      self::mergeTypehintPair($a->getTypehint(), $b->getTypehint()),
      ($a->isAbstract() || $b->isAbstract())
        ? AbstractnessToken::IS_ABSTRACT
        : AbstractnessToken::NOT_ABSTRACT,
    );
  }

  private static function mergeDefinitionListsByName<T as ScannedDefinition>(
    vec<T> $a,
    vec<T> $b,
  ): vec<T> {
    $in = Vec\concat($a, $b);

    $merged = dict[];
    foreach ($in as $def) {
      $key = self::normalizeNameForMerge($def->getName());
      $merged[$key] = self::mergeDefinitionPair($def, $merged[$key] ?? null);
    }
    return vec(/* HH_FIXME[4110] need reified generics*/ $merged);
  }

  private static function mergeGenerics(
    vec<ScannedGeneric> $a,
    vec<ScannedGeneric> $b,
  ): vec<ScannedGeneric> {
    if (C\is_empty($a)) {
      return $b;
    }
    if (C\is_empty($b)) {
      return $a;
    }

    $grouped = Dict\group_by(
      Vec\concat($a, $b),
      $generic ==> self::normalizeNameForMerge($generic->getName()),
    );

    $generics = vec[];
    foreach ($grouped as $for_type) {
      $name = C\firstx($for_type)->getName();
      $variance = VarianceToken::INVARIANT;
      foreach ($for_type as $generic) {
        if (Str\starts_with($generic->getName(), "HH\\")) {
          $name = $generic->getName();
        }
        if ($generic->isContravariant()) {
          $variance = VarianceToken::CONTRAVARIANT;
        } else if ($generic->isCovariant()) {
          $variance = VarianceToken::COVARIANT;
        }
      }
      $constraints = $for_type
        |> Vec\map($$, $g ==> $g->getConstraints())
        |> Vec\flatten($$)
        |> Dict\group_by(
          $$,
          $c ==> self::normalizeNameForMerge($c['type']->getTypeText()),
        )
        |> Vec\map(
          $$,
          $constraints_for_type ==> {
            $type = C\firstx($constraints_for_type)['type'];
            foreach ($constraints_for_type as $constraint) {
              if (Str\starts_with($constraint['type']->getTypeText(), "HH\\")) {
                $type = $constraint['type'];
                break;
              }
            }
            return $constraints_for_type
              |> Keyset\map($$, $c ==> $c['relationship'])
              |> Vec\map(
                $$,
                $r ==> shape('type' => $type, 'relationship' => $r),
              );
          },
        )
        |> Vec\flatten($$);
      $generics[] = new ScannedGeneric($name, $variance, $constraints);
    }
    return $generics;
  }

  private static function mergeTypehintLists(
    vec<ScannedTypehint> $a,
    vec<ScannedTypehint> $b,
  ): vec<ScannedTypehint> {
    if (C\is_empty($a)) {
      return $b;
    }
    if (C\is_empty($b)) {
      return $a;
    }

    return Vec\concat($a, $b)
      |> Dict\group_by(
        $$,
        $th ==> self::normalizeNameForMerge($th->getTypeName()),
      )
      |> Vec\map(
        $$,
        $typehints ==> {
          $first = C\firstx($typehints);
          if (C\count($typehints) === 1) {
            return $first;
          }
          $rest = Vec\drop($typehints, 1);

          $generics = $first->getGenericTypes();
          $kind = $first->getKind();
          $name = $first->getTypeName();
          $nullable = $first->isNullable();
          $shape_fields = $first->isShape() ? $first->getShapeFields() : null;
          $function_typehints = $first->getFunctionTypehints();

          foreach ($rest as $th) {
            $name = self::mergeNames($name, $th->getTypeName());
            $kind ??= $th->getKind();
            $nullable = $nullable || $th->isNullable();
            $generics = self::mergeTypehintLists(
              $generics,
              $th->getGenericTypes(),
            );
            if ($th->isShape()) {
              $shape_fields = $th->getShapeFields();
            }
            $function_typehints ??= $th->getFunctionTypehints();
          }
          return new ScannedTypehint(
            $first->getAST(),
            $kind,
            $name,
            $generics,
            $name !== 'mixed' && $nullable,
            $shape_fields,
            $function_typehints,
          );
        },
      );
  }

  private static function mergeNames(string $a, string $b): string {
    if ($a === 'mixed') {
      return $b;
    }
    if ($b === 'mixed') {
      return $a;
    }
    if ($a === 'object' || $a === "HH\\object") {
      return $b;
    }
    if ($b === 'object' || $b === "HH\\object") {
      return $a;
    }

    if (Str\starts_with($a, "HH\\")) {
      return $a;
    }
    if (Str\starts_with($b, "HH\\")) {
      return $b;
    }
    return (Str\length($a) > Str\length($b)) ? $a : $b;
  }

  private static function mergeTypehintPair<
    T as ?ScannedTypehint super ?ScannedTypehint,
  >(T $a, ?T $b): T {
    if ($b === null) {
      return $a;
    }
    if ($a === null) {
      return $b;
    }

    return new ScannedTypehint(
      $a->getAST(),
      $a->getKind() ?? $b->getKind(),
      self::mergeNames($a->getTypeName(), $b->getTypeName()),
      self::mergeTypehintLists($a->getGenericTypes(), $b->getGenericTypes()),
      ($a->isNullable() || $b->isNullable()),
      $a->isShape()
        ? $a->getShapeFields()
        : ($b->isShape() ? $b->getShapeFields() : null),
      $a->getFunctionTypehints() ?? $b->getFunctionTypehints(),
    );
  }

  private static function mergeAttributes(
    dict<string, vec<mixed>> $a,
    ?dict<string, vec<mixed>> $b,
  ): dict<string, vec<mixed>> {
    if ($b === null) {
      return $a;
    }
    if (C\is_empty($a)) {
      return $b;
    }
    if (C\is_empty($b)) {
      return $a;
    }
    $keys = Keyset\union(Keyset\keys($a), Keyset\keys($b));
    return Dict\map(
      $keys,
      $key ==> {
        $merged = Vec\concat($a[$key] ?? vec[], $b[$key] ?? vec[]);
        $values = vec[];
        foreach ($merged as $value) {
          if (!C\contains($values, $value)) {
            $values[] = $value;
          }
        }
        return $values;
      },
    );
  }

  private static function mergeDocComments(?string $a, ?string $b): ?string {
    // This almost always means we picked up a file header instead of an actual
    // doc comment.
    if (Str\contains((string)$a, 'Copyright')) {
      $a = null;
    }
    if (Str\contains((string)$b, 'Copyright')) {
      $b = null;
    }
    if ($a === null) {
      return $b;
    }
    if ($b === null) {
      return $a;
    }

    return (Str\length($a) > Str\length($b)) ? $a : $b;
  }

  private static function mergeFunctionPair(
    ScannedFunction $a,
    ScannedDefinition $b,
  ): ScannedFunction {
    assert($b is ScannedFunction);
    return new ScannedFunction(
      $a->getASTx(),
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair($a->getReturnType(), $b->getReturnType()),
      self::mergeParameterLists($a->getParameters(), $b->getParameters()),
    );
  }

  private static function mergeMethodPair(
    ScannedMethod $a,
    ScannedDefinition $b,
  ): ScannedMethod {
    assert($b is ScannedMethod);

    if ($a->isPrivate() || $b->isPrivate()) {
      $visibility = VisibilityToken::T_PRIVATE;
    } else if ($a->isProtected() || $b->isProtected()) {
      $visibility = VisibilityToken::T_PROTECTED;
    } else {
      $visibility = VisibilityToken::T_PUBLIC;
    }
    $a_attributes = $a->getAttributes();

    // Can't give reasonable documentation for this, so mark it as nodoc
    if ($a->isStatic() !== $b->isStatic()) {
      \fprintf(
        \STDERR,
        "\n Warning: Method %s has both a static and non-static ".
        "definition:\n- %s:%d\n- %s:%d\n- NOT DOCUMENTING THIS FUNCTION\n",
        $a->getName(),
        $a->getFileName(),
        $a->getPosition()['line'] ?? 0,
        $b->getFileName(),
        $b->getPosition()['line'] ?? 0,
      );
      $a_attributes['NoDoc'] = Vec\concat(
        $a_attributes['NoDoc'] ?? vec[],
        vec[self::class, 'static and non static definitions'],
      );
    }

    if ($a->isAbstract() !== $b->isAbstract()) {
      \fprintf(
        \STDERR,
        "\nWarning: Method %s has both an abstract and non-abstract ".
        "definition:\n- %s:%d\n- %s:%d\n",
        $a->getName(),
        $a->getFileName(),
        $a->getPosition()['line'] ?? 0,
        $b->getFileName(),
        $b->getPosition()['line'] ?? 0,
      );
    }

    if ($a->isFinal() !== $b->isFinal()) {
      \fprintf(
        \STDERR,
        "\nWarning: Method %s has both a final and non-final definition:\n".
        "- %s:%d\n- %s:%d\n",
        $a->getName(),
        $a->getFileName(),
        $a->getPosition()['line'] ?? 0,
        $b->getFileName(),
        $b->getPosition()['line'] ?? 0,
      );
    }

    return new ScannedMethod(
      $a->getASTx(),
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a_attributes, $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair($a->getReturnType(), $b->getReturnType()),
      self::mergeParameterLists($a->getParameters(), $b->getParameters()),
      $visibility,
      $a->isStatic() ? StaticityToken::IS_STATIC : StaticityToken::NOT_STATIC,
      ($a->isAbstract() || $b->isAbstract())
        ? AbstractnessToken::IS_ABSTRACT
        : AbstractnessToken::NOT_ABSTRACT,
      ($a->isFinal() || $b->isFinal())
        ? FinalityToken::IS_FINAL
        : FinalityToken::NOT_FINAL,
    );
  }

  private static function mergeParameterLists(
    vec<ScannedParameter> $a,
    vec<ScannedParameter> $b,
  ): vec<ScannedParameter> {
    $ac = C\count($a);
    $bc = C\count($b);
    $count = Math\minva($ac, $bc);
    if ($count === 0) {
      return vec[];
    }

    return Vec\map(
      \range(0, $count - 1),
      $i ==> self::mergeParameterPair($a[$i], $b[$i]),
    );
  }

  private static function mergeParameterPair(
    ScannedParameter $a,
    ScannedParameter $b,
  ): ScannedParameter {
    $visibility = null;
    if ($a->__isPromoted()) {
      $visibility = $a->__getVisibility();
    } else if ($b->__isPromoted()) {
      $visibility = $b->__getVisibility();
    }
    $default = null;
    if ($a->isOptional()) {
      $default = $a->getDefault();
    }
    if ($b->isOptional()) {
      $bds = TypeAssert\not_null($b->getDefault());
      if (
        $default === null ||
        Str\length($bds->getAST()->getCode()) >
          Str\length($default->getAST()->getCode())
      ) {
        $default = $bds;
      }
    }

    return new ScannedParameter(
      $a->getASTx(),
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeTypehintPair($a->getTypehint(), $b->getTypehint()),
      $a->isInOut() || $b->isInOut(),
      $a->isVariadic() || $b->isVariadic(),
      $default,
      $visibility,
    );
  }

  private static function mergeClassishPair(
    ScannedClassish $a,
    ScannedDefinition $b,
  ): ScannedClassish {
    assert($b is ScannedClassish);

    $name = self::mergeNames($a->getName(), $b->getName());

    $agc = C\count($a->getGenericTypes());
    $bgc = C\count($b->getGenericTypes());
    invariant(
      $agc === 0 || $bgc === 0 || $agc === $bgc,
      '%s has differing numbers of generics',
      $name,
    );

    if ($a is ScannedClass) {
      $class = ScannedClass::class;
    } else if ($a is ScannedInterface) {
      $class = ScannedInterface::class;
    } else if ($a is ScannedTrait) {
      $class = ScannedTrait::class;
    } else {
      invariant_violation("Don't know how to handle class %s", \get_class($a));
    }

    return new $class(
      $a->getASTx(),
      $name,
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeDefinitionListsByName($a->getMethods(), $b->getMethods()),
      self::mergeDefinitionListsByName(
        $a->getProperties(),
        $b->getProperties(),
      ),
      self::mergeDefinitionListsByName($a->getConstants(), $b->getConstants()),
      self::mergeDefinitionListsByName(
        $a->getTypeConstants(),
        $b->getTypeConstants(),
      ),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair(
        $a->getParentClassInfo(),
        $b->getParentClassInfo(),
      ),
      self::mergeTypehintLists($a->getInterfaceInfo(), $b->getInterfaceInfo()),
      self::mergeTypehintLists($a->getTraitInfo(), $b->getTraitInfo()),
      ($a->isAbstract() || $b->isAbstract())
        ? AbstractnessToken::IS_ABSTRACT
        : AbstractnessToken::NOT_ABSTRACT,
      ($a->isFinal() || $b->isFinal())
        ? FinalityToken::IS_FINAL
        : FinalityToken::NOT_FINAL,
    );
  }

  private static function getMergeKey(Documentable $def): string {
    $parent = $def['parent'];
    $def = $def['definition'];
    if ($parent) {
      $name = self::normalizeNameForMerge($parent->getName()).'::';
    } else {
      $name = '';
    }
    $name .= self::normalizeNameForMerge($def->getName());
    return \get_class($def).'$'.$name;
  }
}
