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

use type Facebook\HHAPIDoc\{Documentable, Documentables};
use type Facebook\DefinitionFinder\{
  AbstractnessToken,
  FinalityToken,
  ScannedBase,
  ScannedBasicClass,
  ScannedClass,
  ScannedFunction,
  ScannedGeneric,
  ScannedInterface,
  ScannedMethod,
  ScannedParameter,
  ScannedTrait,
  ScannedTypehint,
  StaticityToken,
  VarianceToken,
  VisibilityToken,
};

use namespace Facebook\{TypeAssert, TypeSpec};
use namespace HH\Lib\{C, Dict, Keyset, Math, Str, Vec};

final class DataMerger {
  private static function normalizeNameForMerge(string $name): string {
    return $name
      |> Str\strip_prefix($$, "HH\\Lib\\")
      |> Str\strip_prefix($$, "HH\\");
  }

  private static function mergePair(
    Documentable $a,
    ?Documentable $b,
  ): Documentable {
    if ($b === null) {
      return $a;
    }

    $sources = Vec\concat($a['sources'], $b['sources']);
    $parent = $a['parent'];
    if ($parent) {
      $parent = self::mergeDefinitionPair(
        $parent,
        $b['parent'],
      );
    } else {
      $parent = $b['parent'];
    }

    $def = self::mergeDefinitionPair(
      $a['definition'],
      $b['definition'],
    );
    return shape(
      'parent' => $parent,
      'sources' => $sources,
      'definition' => $def,
    );
  }

  private static function mergeDefinitionPair<T as ScannedBase>(
    T $a,
    ?T $b,
  ): T {
    if ($b === null) {
      return $a;
    }

    if ($a instanceof ScannedClass) {
      return self::mergeClassishPair($a, $b);
    }

    if ($a instanceof ScannedFunction) {
      return self::mergeFunctionPair($a, $b);
    }

    if ($a instanceof ScannedMethod) {
      return self::mergeMethodPair($a, $b);
    }

    invariant_violation('Unhandled type %s', \get_class($a));
  }

  private static function mergeDefinitionListsByName<T as ScannedBase>(
    vec<T> $a,
    vec<T> $b,
  ): vec<T> {
    $in = Vec\concat($a, $b);

    $merged = dict[];
    foreach ($in as $def) {
      $key = self::normalizeNameForMerge($def->getName());
      $merged[$key] = self::mergeDefinitionPair($def, $merged[$key] ?? null);
    }
    return vec($merged);
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
        |> Dict\group_by($$, $c ==> self::normalizeNameForMerge($c['type']))
        |> Vec\map($$, $constraints_for_type ==> {
          $type = C\firstx($constraints_for_type)['type'];
          foreach ($constraints_for_type as $constraint) {
            if (Str\starts_with($constraint['type'], "HH\\")) {
              $type = $constraint['type'];
              break;
            }
          }
          return $constraints_for_type
            |> Keyset\map($$, $c ==> $c['relationship'])
            |> Vec\map($$, $r ==> shape('type' => $type, 'relationship' => $r));
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
          $name = $first->getTypeName();
          $base = $first->getTypeTextBase();
          $nullable = $first->isNullable();

          foreach ($rest as $th) {
            $new_name = self::mergeNames($name, $th->getTypeName());
            if ($new_name !== $name) {
              $name = $new_name;
              $base = $th->getTypeTextBase();
            }

            $nullable = $nullable || $th->isNullable();
            $generics = self::mergeTypehintLists(
              $generics,
              $th->getGenericTypes(),
            );
          }
          return new ScannedTypehint(
            $name,
            $base,
            $generics,
            $name !== 'mixed' && $nullable,
          );
        },
      );
  }

  private static function mergeNames(
    string $a,
    string $b,
  ): string {
    if ($a === 'mixed') {
      return $b;
    }
    if ($b === 'mixed') {
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
    T as ?ScannedTypehint super ?ScannedTypehint
  >(
    T $a,
    ?T $b,
  ): T {
    if ($b === null) {
      return $a;
    }
    if ($a === null) {
      return $b;
    }

    $name = self::mergeNames($a->getTypeName(), $b->getTypeName());
    $base = ($name === $a->getTypeName())
      ? $a->getTypeTextBase()
      : $b->getTypeTextBase();

    return new ScannedTypehint(
      $name,
      $base,
      self::mergeTypehintLists($a->getGenericTypes(), $b->getGenericTypes()),
      ($a->isNullable() || $b->isNullable()),
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
      }
    );
  }

  private static function mergeDocComments(
    ?string $a,
    ?string $b,
  ): ?string {
    // This almost always means we picked up a file header instead of an actual
    // doc comment.
    if (Str\contains((string) $a, 'Copyright')) {
      $a = null;
    }
    if (Str\contains((string) $b, 'Copyright')) {
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
    ScannedBase $b,
  ): ScannedFunction {
    assert($b instanceof ScannedFunction);
    return new ScannedFunction(
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
    ScannedBase $b,
  ): ScannedMethod {
    assert($b instanceof ScannedMethod);

    if ($a->isPrivate() || $b->isPrivate()) {
      $visibility = VisibilityToken::T_PRIVATE;
    } else if ($a->isProtected() || $b->isProtected()) {
      $visibility = VisibilityToken::T_PROTECTED;
    } else {
      $visibility = VisibilityToken::T_PUBLIC;
    }
    invariant(
      $a->isStatic() === $b->isStatic(),
      '%s has both a static and non-static definition',
      $a->getName(),
    );
    invariant(
      $a->isAbstract() === $b->isAbstract(),
      '%s has both an abstract and non-abstract definition',
      $a->getName(),
    );
    invariant(
      $a->isFinal() === $b->isFinal(),
      '%s has both a final and non-final definition',
      $a->getName(),
    );

    return new ScannedMethod(
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair($a->getReturnType(), $b->getReturnType()),
      self::mergeParameterLists($a->getParameters(), $b->getParameters()),
      $visibility,
      $a->isStatic() ? StaticityToken::IS_STATIC : StaticityToken::NOT_STATIC,
      $a->isAbstract()
        ? AbstractnessToken::IS_ABSTRACT : AbstractnessToken::NOT_ABSTRACT,
      $a->isFinal() ? FinalityToken::IS_FINAL : FinalityToken::NOT_FINAL,
    );
  }

  private static function mergeParameterLists(
    vec<ScannedParameter> $a,
    vec<ScannedParameter> $b,
  ): vec<ScannedParameter> {
    $ac = C\count($a);
    $bc = C\count($b);
    $count = Math\minva($ac, $bc);

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
      $default = $a->getDefaultString();
    }
    if ($b->isOptional()) {
      $bds = $b->getDefaultString();
      if ($default === null || Str\length($bds) > Str\length($default)) {
        $default = $bds;
      }
    }

    return new ScannedParameter(
      self::mergeNames($a->getName(), $b->getName()),
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeTypehintPair($a->getTypehint(), $b->getTypehint()),
      $a->isPassedByReference() || $b->isPassedByReference(),
      $a->isInOut() || $b->isInOut(),
      $a->isVariadic() || $b->isVariadic(),
      $default,
      $visibility,
    );
  }

  private static function mergeClassishPair(
    ScannedClass $a,
    ScannedBase $b,
  ): ScannedClass {
    assert($b instanceof ScannedClass);

    $name = self::mergeNames($a->getName(), $b->getName());

    $agc = C\count($a->getGenericTypes());
    $bgc = C\count($b->getGenericTypes());
    invariant(
      $agc === 0 || $bgc === 0 || $agc === $bgc,
      '%s has differing numbers of generics',
      $name,
    );

    if ($a instanceof ScannedBasicClass) {
      $class = ScannedBasicClass::class;
    } else if ($a instanceof ScannedInterface) {
      $class = ScannedInterface::class;
    } else if ($a instanceof ScannedTrait) {
      $class = ScannedTrait::class;
    } else {
      invariant_violation(
        "Don't know how to handle class %s",
        \get_class($a),
      );
    }

    return new $class(
      $name,
      $a->getContext(),
      self::mergeAttributes($a->getAttributes(), $b->getAttributes()),
      self::mergeDocComments($a->getDocComment(), $b->getDocComment()),
      self::mergeDefinitionListsByName($a->getMethods(), $b->getMethods()),
      self::mergeDefinitionListsByName($a->getProperties(), $b->getProperties()),
      self::mergeDefinitionListsByName($a->getConstants(), $b->getConstants()),
      self::mergeDefinitionListsByName($a->getTypeConstants(), $b->getTypeConstants()),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair($a->getParentClassInfo(), $b->getParentClassInfo()),
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
