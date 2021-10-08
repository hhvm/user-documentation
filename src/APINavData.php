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

final class APINavData {
  private APIIndex $index;
  private APIProduct $product;

  private function __construct(APIProduct $product) {
    $this->index = APIIndex::get($product);
    $this->product = $product;
  }

  <<__Memoize>>
  public static function get(APIProduct $product): this {
    return new self($product);
  }

  public function getNavData(): dict<string, NavDataNode> {
    $product = $this->product;
    return dict[
      'Classes' => $this->getNavDataForClasses(APIDefinitionType::CLASS_DEF, $product),
      'Interfaces' =>
        $this->getNavDataForClasses(APIDefinitionType::INTERFACE_DEF, $product),
      'Traits' => $this->getNavDataForClasses(APIDefinitionType::TRAIT_DEF, $product),
      'Functions' => shape(
        'name' => 'Functions',
        'urlPath' => '/'.$product.'/reference/function/',
        'children' => $this->getNavDataForFunctions(),
      ),
    ];
  }

  public function getRootNameForType(APIDefinitionType $class_type): string {
    switch ($class_type) {
      case APIDefinitionType::CLASS_DEF:
        return 'Classes';
      case APIDefinitionType::INTERFACE_DEF:
        return 'Interfaces';
      case APIDefinitionType::TRAIT_DEF:
        return 'Traits';
      case APIDefinitionType::FUNCTION_DEF:
        return 'Functions';
    }
  }

  private function getNavDataForClasses(
    APIDefinitionType $class_type,
    APIProduct $product,
  ): NavDataNode {
    $nav_data = dict[];
    $classes = $this->index->getClassIndex($class_type);

    foreach ($classes as $class) {
      $nav_data[$class['name']] = shape(
        'name' => $class['name'],
        'urlPath' => $class['urlPath'],
        'children' => $this->getNavDataForMethods($class['methods']),
      );
    }
    return shape(
      'name' => $this->getRootNameForType($class_type),
      'urlPath' => '/'.$product.'/reference/'.$class_type.'/',
      'children' => $nav_data,
    );
  }

  private function getNavDataForMethods(
    dict<string, APIMethodIndexEntry> $methods,
  ): dict<string, NavDataNode> {
    $nav_data = dict[];
    foreach ($methods as $method) {
      $nav_data[$method['name']] = shape(
        'name' => $method['name'],
        'urlPath' => $method['urlPath'],
        'children' => dict[],
      );
    }
    return $nav_data;
  }

  private function getNavDataForFunctions(): dict<string, NavDataNode> {
    $functions = $this->index->getFunctionIndex();

    $nav_data = dict[];
    foreach ($functions as $function) {
      $nav_data[$function['name']] = shape(
        'name' => $function['name'],
        'urlPath' => $function['urlPath'],
        'children' => dict[],
      );
    }
    return $nav_data;
  }
}
