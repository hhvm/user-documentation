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
use namespace HH\Lib\Vec;

final class APIIndex {
  private ProductAPIIndexShape $index;

  private function __construct(private APIProduct $product) {
    $idx = self::getRawIndex();
    switch ($product) {
      case APIProduct::HACK:
        $this->index = $idx[APIProduct::HACK];
        break;
      case APIProduct::HSL:
        $this->index = $idx[APIProduct::HSL];
        break;
    }
  }

  <<__Memoize>>
  public static function get(APIProduct $product): APIIndex {
    return new self($product);
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
  private static function getRawIndex(): APIIndexShape {
    return apc_fetch_or_set_class_data(
      self::class,
      () ==> JSON\decode_as_shape(
        APIIndexShape::class,
        \file_get_contents(BuildPaths::APIDOCS_INDEX_JSON),
      ),
    );
  }

  public function getIndexForType(
    APIDefinitionType $type,
  ): dict<string, APIIndexEntry> {
    $index = Shapes::toArray($this->index);
    invariant(
      \array_key_exists($type, $index),
      'invalid type: %s',
      (string)$type,
    );
    return $index[$type];
  }

  public function getFunctionIndex(): dict<string, APIFunctionIndexEntry> {
    return $this->index['function'];
  }

  public function getClassIndex(
    APIDefinitionType $type,
  ): dict<string, APIClassIndexEntry> {
    switch ($type) {
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

  public function search(string $term): vec<SearchResult> {
    return APIDefinitionType::getValues()
      |> Vec\map($$, $type ==> $this->searchEntries($term, $type))
      |> Vec\flatten($$);
  }

  private function getMethods(APIIndexEntry $entry): ?vec<APIMethodIndexEntry> {
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

  private function searchEntries(
    string $term,
    APIDefinitionType $type,
  ): vec<SearchResult> {
    $results = vec[];

    $entries = $this->getIndexForType($type);
    foreach ($entries as $_ => $entry) {
      $name = $entry['name'];

      $score = SearchTermMatcher::matchTerm($name, $term);
      if ($score !== null) {
        $results[] = new APISearchResult(
          $this->product,
          $type,
          $name,
          $entry['urlPath'],
          $score,
        );
      }

      $methods = $this->getMethods($entry);
      if ($methods === null) {
        continue;
      }
      foreach ($methods as $method) {
        $name = $entry['name'].'::'.$method['name'];
        $score = SearchTermMatcher::matchTerm($name, $term);
        if ($score !== null) {
          $results[] = new APISearchResult(
            $this->product,
            APIDefinitionType::FUNCTION_DEF,
            $name,
            $method['urlPath'],
            $score,
          );
        }
      }
    }

    return $results;
  }

  public function getDataForFunction(string $name): APIFunctionIndexEntry {
    $index = $this->index;
    invariant(
      \array_key_exists($name, $index['function']),
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
      \array_key_exists($class_name, $index),
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
      \array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    $class = $index[$class_name];
    $methods = $class['methods'];
    invariant(
      \array_key_exists($method_name, $methods),
      'Method %s::%s does not exist',
      $class_name,
      $method_name,
    );
    return $methods[$method_name];
  }
}
