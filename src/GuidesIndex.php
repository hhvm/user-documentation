<?hh
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

use namespace HH\Lib\{C, Vec};

final class GuidesIndex {
  public static function getIndex(
  ): dict<GuidesProduct, dict<string, dict<string, string>>> {
    return GuidesIndexData::getIndex();
  }

  public static function getProductIndex(
    GuidesProduct $product,
  ): dict<string, dict<string, string>> {
    $index = self::getIndex();
    invariant(
      C\contains_key($index, $product),
      '%s is not in the guide index',
      $product,
    );
    return $index[$product];
  }

  private static function getCategories(
  ): dict<GuidesProduct, dict<string, string>> {
    return GuidesCategoryData::getData();
  }


  private static function getSummaries(
  ): dict<GuidesProduct, dict<string, string>> {
    return GuidesSummaryData::getData();
  }

  public static function search(string $term): vec<SearchResult> {
    $results = vec[];

    $index = self::getIndex();
    foreach ($index as $product => $value) {
      foreach ($value as $guide => $entry) {
        foreach ($entry as $page => $filepath) {
          $name = Guides::normalizeName($product, $guide, $page);
          $score = SearchTermMatcher::matchTerm($name, $term);
          if ($score !== null) {
            if ($page === 'introduction') {
              $score *= SearchScores::GUIDE_INTRODUCTION_MULTIPLIER;
            }
            $results[] = new GuidePageSearchResult(
              $product,
              $guide,
              $page,
              $score,
            );
            continue;
          }
          $content = \file_get_contents(BuildPaths::GUIDES_HTML.'/'.$filepath);
          if ($content === false) {
            continue;
          }
          $content = \html_entity_decode(\strip_tags($content));
          $score = SearchTermMatcher::matchTerm($content, $term);
          if ($score === null) {
            continue;
          }
          $results[] = new GuidePageSearchResult(
            $product,
            $guide,
            $page,
            $score * SearchScores::CONTENT_MATCH_MULTIPLIER,
          );
        }
      }
    }

    return $results;
  }

  public static function getProducts(): vec<string> {
    return Vec\keys(self::getIndex());
  }

  public static function getGuides(GuidesProduct $product): vec<string> {
    $index = self::getIndex();
    invariant(
      C\contains_key($index, $product),
      '%s is not in the guide index',
      $product,
    );
    return Vec\keys($index[$product]);
  }

  public static function getPages(
    GuidesProduct $product,
    string $guide,
  ): vec<string> {
    $index = self::getIndex();
    invariant(C\contains_key($index, $product), 'no guides for %s', $product);
    invariant(
      C\contains_key($index[$product], $guide),
      '%s does not contain a %s guide',
      $product,
      $guide,
    );
    return Vec\keys(self::getIndex()[$product][$guide]);
  }

  public static function getFileForCategory(
    GuidesProduct $product,
    string $guide,
  ): string {
    $categories = self::getCategories();
    $path = $categories[$product][$guide] ?? null;
    invariant(
      $path !== null,
      'Product %s does not contain category %s',
      $product,
      $guide,
    );
    return __DIR__.'/../guides/'.$categories[$product][$guide];
  }

  public static function getFileForSummary(
    GuidesProduct $product,
    string $guide,
  ): string {
    $summaries = self::getSummaries();
    $path = $summaries[$product][$guide] ?? null;
    invariant(
      $path !== null,
      'Product %s does not contain summary %s',
      $product,
      $guide,
    );
    return __DIR__.'/../guides/'.$summaries[$product][$guide];
  }

  public static function getFileForPage(
    GuidesProduct $product,
    string $guide,
    string $page,
  ): string {
    $index = self::getIndex();
    $entry = $index[$product][$guide][$page] ?? null;
    invariant(
      $entry !== null,
      'Guide %s/%s does not include page %s',
      $product,
      $guide,
      $page,
    );
    return BuildPaths::GUIDES_HTML.'/'.$entry;
  }
}
