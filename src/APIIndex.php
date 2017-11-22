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

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Math, Str, Vec};

final class APIIndex {
  private function __construct(
    private ProductAPIIndexShape $index,
  ) {
  }

  <<__Memoize>>
  public static function get(APIProduct $product): APIIndex {
    $idx = self::getRawIndex();
    switch ($product) {
      case APIProduct::HACK:
        return new self($idx[APIProduct::HACK]);
      case APIProduct::HSL:
        return new self($idx[APIProduct::HSL]);
      case APIProduct::PHP:
        invariant_violation("Can't handle PHP index");
    }
  }

  public function getIndex(): ProductAPIIndexShape {
    return $this->index;
  }

  public static function searchAllProducts(string $term): vec<SearchResult> {
    return Vec\concat(
      self::get(APIProduct::HACK)->search($term),
      self::get(APIProduct::HSL)->search($term),
    );
  }

  <<__Memoize>>
  private static function getRawIndex(
  ): APIIndexShape {
    $key = __CLASS__.'!'.LocalConfig::getBuildID();

    $success = false;
    $data = apc_fetch($key, $success);
    $success = false;
    if ($success) {
      return $data;
    }

    $data = JSON\decode_as_shape(
      APIIndexShape::class,
      \file_get_contents(BuildPaths::APIDOCS_INDEX_JSON),
    );
    apc_store($key, $data);
    return $data;
  }

  public function getIndexForType(
    APIDefinitionType $type,
  ): array<string, APIIndexEntry> {
    $index = Shapes::toArray($this->index);
    invariant(
      array_key_exists($type, $index),
      'invalid type: %s',
      (string) $type,
    );
    return $index[$type];
  }

  public function getFunctionIndex(
  ): array<string, APIFunctionIndexEntry> {
    return $this->index['function'];
  }

  public function getClassIndex(
    APIDefinitionType $type,
  ): array<string, APIClassIndexEntry> {
    switch($type) {
      case APIDefinitionType::FUNCTION_DEF:
        invariant_violation('functions are not classes');
      case APIDefinitionType::CLASS_DEF:
        return $this->index['class'];
      case APIDefinitionType::INTERFACE_DEF:
        return $this->index['interface'];
      case APIDefinitionType::TRAIT_DEF:
        return $this->index['trait'];
    }
  }

  public function search(
    string $term,
  ): vec<SearchResult> {
    return APIDefinitionType::getValues()
      |> Vec\map($$, $type ==> $this->searchEntries($term, $type))
      |> Vec\flatten($$);
  }

  private function getMethods(
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

  private function searchEntries (
    string $term,
    APIDefinitionType $type,
  ): vec<SearchResult> {
    $terms = Str\split($term, ' ');
    $results = vec[];

    $entries = $this->getIndexForType($type);
    foreach ($entries as $_ => $entry) {
      $name = $entry['name'];
      $type = Str\contains($name, "HH\\Lib\\")
        ? SearchResultType::HSL_API
        : SearchResultType::HACK_API;

      $score = SearchTermMatcher::matchTerm($name, $term);
      if ($score !== null) {
        $results[] = new SearchResult($type, $score, $name, $entry['urlPath']);
      }

      $methods = $this->getMethods($entry);
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

  public function getDataForFunction(
    string $name,
  ): APIFunctionIndexEntry {
    $index = $this->index;
    invariant(
      array_key_exists($name, $index['function']),
      'function %s does not exist',
      $name,
    );
    return $index['function'][$name];
  }

  public function getDataForClass(
    APIDefinitionType $class_type,
    string $class_name,
  ): APIClassIndexEntry {
    $index = $this->getClassIndex($class_type);
    invariant(
      array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    return $index[$class_name];
  }

  public function getDataForMethod(
    APIDefinitionType $class_type,
    string $class_name,
    string $method_name,
  ): APIMethodIndexEntry {
    $index = $this->getClassIndex($class_type);
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
