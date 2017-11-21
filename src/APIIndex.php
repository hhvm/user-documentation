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

require(BuildPaths::APIDOCS_INDEX);

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Math, Str, Vec};

final class APIIndex {
  public static function getIndex(
  ): APIIndexShape {
    return APIIndexData::getIndex();
  }

  public static function getIndexForType(
    APIDefinitionType $type,
  ): array<string, APIIndexEntry> {
    $index = Shapes::toArray(self::getIndex());
    invariant(
      array_key_exists($type, $index),
      'invalid type: %s',
      (string) $type,
    );
    // UNSAFE
    return $index[$type];
  }

  public static function getFunctionIndex(
  ): array<string, APIFunctionIndexEntry> {
    return self::getIndex()['function'];
  }

  public static function getClassIndex(
    APIDefinitionType $type,
  ): array<string, APIClassIndexEntry> {
    invariant(
      $type !== APIDefinitionType::FUNCTION_DEF,
      'functions are not classes',
    );
    // UNSAFE
    return self::getIndex()[$type];
  }

  public static function search(
    string $term,
  ): vec<SearchResult> {
    return APIDefinitionType::getValues()
      |> Vec\map($$, $type ==> self::searchEntries($term, $type))
      |> Vec\flatten($$);
  }

  private static function getMethods(
    APIIndexEntry $entry,
  ): ?vec<APIMethodIndexEntry> {
    $arr = Shapes::toArray($entry);
    $methods = $arr['methods'] ?? null;
    if ($methods !== null) {
      return Vec\map(
        /* HH_IGNORE_ERROR[4110] */ $methods,
        $method ==> TypeAssert\matches_type_structure(
          type_alias_structure(APIMethodIndexEntry::class),
          $method,
        ),
      );
    }
    return null;
  }

  private static function searchEntries (
    string $term,
    APIDefinitionType $type,
  ): vec<SearchResult> {
    $terms = Str\split($term, ' ');
    $results = vec[];

    $entries = self::getIndexForType($type);
    foreach ($entries as $_ => $entry) {
      $name = $entry['name'];
      $type = Str\contains($name, "HH\\Lib\\")
        ? SearchResultType::HSL_API
        : SearchResultType::HACK_API;

      $score = SearchTermMatcher::matchTerm($name, $term);
      if ($score !== null) {
        $results[] = new SearchResult($type, $score, $name, $entry['urlPath']);
      }

      $methods = self::getMethods($entry);
      if ($methods === null) {
        continue;
      }
      foreach ($methods as $method) {
        $name = $entry['name'].'::'.$method['name'];
        $score = SearchTermMatcher::matchTerm($name, $term);
        if ($score !== null) {
          $results[] = new SearchResult($type, $score, $name, $method['urlPath']);
        }
      }
    }

    return $results;
  }

  public static function getDataForFunction(
    string $name,
  ): APIFunctionIndexEntry {
    $index = self::getIndex();
    invariant(
      array_key_exists($name, $index['function']),
      'function %s does not exist',
      $name,
    );
    return $index['function'][$name];
  }

  public static function getDataForClass(
    APIDefinitionType $class_type,
    string $class_name,
  ): APIClassIndexEntry {
    $index = self::getClassIndex($class_type);
    invariant(
      array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    return $index[$class_name];
  }

  public static function getDataForMethod(
    APIDefinitionType $class_type,
    string $class_name,
    string $method_name,
  ): APIMethodIndexEntry {
    $index = self::getClassIndex($class_type);
    invariant(
      array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    $class = $index[$class_name];
    $methods = $class['methods'];
    invariant(
      array_key_exists($method_name, $methods),
      'Method %s::%s does not exist',
      $class_name,
      $method_name,
    );
    return $methods[$method_name];
  }
}
