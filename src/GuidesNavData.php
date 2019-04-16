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

final class GuidesNavData {
  public static function getNavData(): dict<string, NavDataNode> {
    $nav_data = dict[];
    foreach (GuidesIndex::getIndex() as $name => $product_guides) {
      $nav_data[$name] = shape(
        'name' => $name,
        'urlPath' => URLBuilder::getPathForProductGuides($name),
        'children' => self::getNavDataForProduct(
          GuidesProduct::assert($name),
          $product_guides,
        ),
      );
    }
    return $nav_data;
  }

  private static function getNavDataForProduct(
    GuidesProduct $product,
    dict<string, dict<string, string>> $product_guides,
  ): dict<string, NavDataNode> {
    $nav_data = dict[];
    foreach ($product_guides as $topic => $pages) {
      $name = self::pathToName($topic);
      $nav_data[$name] = shape(
        'name' => $name,
        'urlPath' => URLBuilder::getPathForGuide($product, $topic),
        'children' => self::getNavDataForGuide(
          $product,
          $topic,
          $pages,
        ),
      );
    }
    return $nav_data;
  }

  private static function getNavDataForGuide(
    GuidesProduct $product,
    string $topic,
    dict<string, string> $pages,
  ): dict<string, NavDataNode> {
    $nav_data = dict[];
    foreach ($pages as $title => $html_file) {
      $name = self::pathToName($title);
      $nav_data[$name] = shape(
        'name' => $name,
        'urlPath' => URLBuilder::getPathForGuidePage($product, $topic, $title),
        'children' => dict[],
      );
    }
    return $nav_data;
  }

  public static function pathToName(string $name): string {
    switch ($name) {
      case 'hh_server':
        return $name;
      case 'faq':
        return 'FAQ';
      default:
        return \ucwords(\strtr($name, '-', ' '));
    }
  }
}
