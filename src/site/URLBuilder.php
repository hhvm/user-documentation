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

final class URLBuilder {
  public static function getPathForClass(
    APIProduct $product,
    shape(
      'name' => string,
      'type' => APIDefinitionType,
      ...
    ) $class,
  ): string {
    return sprintf(
      '/%s/reference/%s/%s/',
      $product,
      $class['type'],
      strtr($class['name'], "\\", '.'),
    );
  }

  public static function getPathForMethod(
    APIProduct $product,
    shape(
      'name' => string,
      'className' => string,
      'classType' => APIDefinitionType,
      ...
    ) $method,
  ): string {
    return sprintf(
      '/%s/reference/%s/%s/%s/',
      $product,
      $method['classType'],
      strtr($method['className'], "\\", '.'),
      $method['name'],
    );
  }

  public static function getPathForFunction(
    APIProduct $product,
    shape(
      'name' => string,
      ...
    ) $function,
  ): string {
    return sprintf(
      '/%s/reference/function/%s/',
      $product,
      strtr($function['name'], "\\", '.'),
    );
  }

  public static function getPathForProductGuides(
    GuidesProduct $product,
  ): string {
    return '/'.$product.'/';
  }

  public static function getPathForGuide(
    GuidesProduct $product,
    string $topic,
  ): string {
    return self::getPathForProductGuides($product).$topic.'/';
  }

  public static function getPathForGuidePage(
    GuidesProduct $product,
    string $topic,
    string $page,
  ): string {
    return self::getPathForGuide($product, $topic).$page;
  }
}
