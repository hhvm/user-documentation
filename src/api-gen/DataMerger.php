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
  ScannedGeneric,
  ScannedInterface,
  ScannedTrait,
  ScannedTypehint,
  VarianceToken,
};

use namespace Facebook\{TypeAssert, TypeSpec};
use namespace HH\Lib\{C, Dict, Keyset, Str, Vec};

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
    return $a;
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
            $new_name = self::mergeTypeNames($name, $th->getTypeName());
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

  private static function mergeTypeNames(
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
    return $b;
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

    $name = self::mergeTypeNames($a->getTypeName(), $b->getTypeName());
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

  private static function mergeClassishPair(
    ScannedClass $a,
    ScannedBase $b,
  ): ScannedClass {
    assert($b instanceof ScannedClass);

    $name = self::mergeTypeNames($a->getName(), $b->getName());

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

    $attributes = dict[]; // TODO FIXME
    $docblock = null; // TODO FIXME
    $interfaces = vec[]; // TODO FIXME
    $traits = vec[]; // TODO FIXME

    return new $class(
      $name,
      $a->getContext(),
      $attributes,
      $docblock,
      self::mergeDefinitionListsByName($a->getMethods(), $b->getMethods()),
      self::mergeDefinitionListsByName($a->getProperties(), $b->getProperties()),
      self::mergeDefinitionListsByName($a->getConstants(), $b->getConstants()),
      self::mergeDefinitionListsByName($a->getTypeConstants(), $b->getTypeConstants()),
      self::mergeGenerics($a->getGenericTypes(), $b->getGenericTypes()),
      self::mergeTypehintPair($a->getParentClassInfo(), $b->getParentClassInfo()),
      $interfaces,
      $traits,
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
