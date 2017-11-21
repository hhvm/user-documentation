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

final class GuidesIndex {
  public static function getIndex(
  ): Map<GuidesProduct, Map<string, Map<string, string>>> {
    return require(BuildPaths::GUIDES_INDEX);
  }

  public static function getProductIndex(
    GuidesProduct $product,
  ): Map<string, Map<string, string>> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      '%s is not in the guide index',
      $product,
    );
    return $index[$product];
  }

  private static function getSummaries(
  ): Map<string, Map<string, string>> {
    return require(BuildPaths::GUIDES_SUMMARY);
  }

  public static function search(
    string $term,
  ): vec<SearchResult> {
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
          $content = file_get_contents(BuildPaths::GUIDES_HTML.'/'.$filepath);
          if ($content === false) {
            continue;
          }
          $content = html_entity_decode(strip_tags($content));
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

  public static function getProducts(): ImmVector<string> {
    return self::getIndex()->keys()->toImmVector();
  }

  public static function getGuides(GuidesProduct $product): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      '%s is not in the guide index',
      $product,
    );
    return $index[$product]->keys()->toImmVector();
  }

  public static function getPages(
    GuidesProduct $product,
    string $guide,
  ): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      'no guides for %s',
      $product,
    );
    invariant(
      $index[$product]->containsKey($guide),
      '%s does not contain a %s guide',
      $product,
      $guide,
    );
    return self::getIndex()[$product][$guide]->keys()->toImmVector();
  }

  public static function getFileForSummary(
    string $product,
    string $guide,
  ): string {
    $summaries = self::getSummaries();
    invariant(
      $summaries->containsKey($product),
      'Product %s does not exist',
      $product,
    );
    invariant(
      $summaries[$product]->containsKey($guide),
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
    invariant(
      $index->containsKey($product),
      'Product %s does not exist',
      $product,
    );
    invariant(
      $index[$product]->containsKey($guide),
      'Product %s does not contain guide %s',
      $product,
      $guide,
    );
    invariant(
      $index[$product][$guide]->containsKey($page),
      'Guide %s/%s does not include page %s',
      $product,
      $guide,
      $page,
    );
    return BuildPaths::GUIDES_HTML.'/'.$index[$product][$guide][$page];
  }
}
