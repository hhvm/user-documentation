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
    return \APIClassPageControllerURIBuilder::getPath(shape(
      'Product' => $product,
      'Name' => \strtr($class['name'], "\\", '.'),
      'Type' => $class['type'],
    ));
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
    return \APIMethodPageControllerURIBuilder::getPath(shape(
      'Product' => $product,
      'Class' => \strtr($method['className'], "\\", '.'),
      'Method' => $method['name'],
      'Type' => $method['classType'],
    ));
  }

  public static function getPathForFunction(
    APIProduct $product,
    shape(
      'name' => string,
      ...
    ) $function,
  ): string {
    return \APIClassPageControllerURIBuilder::getPath(shape(
      'Product' => $product,
      'Name' => \strtr($function['name'], "\\", '.'),
      'Type' => APIDefinitionType::FUNCTION_DEF,
    ));
  }

  public static function getPathForProductGuides(
    GuidesProduct $product,
  ): string {
    return \GuidesListControllerURIBuilder::getPath(shape(
      'Product' => $product,
    ));
  }

  public static function getPathForProductAPIReference(
    APIProduct $product,
  ): string {
    invariant(
      $product !== APIProduct::PHP,
      'No reference pages for PHP',
    );
    return \APIFullListControllerURIBuilder::getPath(shape(
      'Product' => $product,
    ));
  }

  public static function getPathForGuide(
    GuidesProduct $product,
    string $topic,
  ): string {
    return \RedirectToGuideFirstPageControllerURIBuilder::getPath(shape(
      'Product' => $product,
      'Guide' => $topic,
    ));
  }

  public static function getPathForGuidePage(
    GuidesProduct $product,
    string $topic,
    string $page,
  ): string {
    return \GuidePageControllerURIBuilder::getPath(shape(
      'Product' => $product,
      'Guide' => $topic,
      'Page' => $page,
    ));
  }
}
