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

use namespace HH\Lib\{C, Math, Str, Vec};

abstract final class SearchTermMatcher {
  const dict<string, keyset<string>> SYNONYMS = dict[
    'vec' => keyset['\\c\\'],
    'dict' => keyset['\\c\\'],
    'keyset' => keyset['\\c\\'],
    'vector' => keyset['vec'],
    'map' => keyset['dict'],
    'set' => keyset['keyset'],
  ];

  protected static function matchFullTerm(
    string $name,
    string $term,
  ): ?float {
    if (Str\length($term) === 0) {
      return null;
    }

    if (Str\compare_ci($term, $name) === 0) {
      return SearchScores::EXACT_MATCH_SCORE;
    }

    if (Str\contains($term, ' ')) {
      return null;
    }

    $multi = 1.0;
    if (Str\length($term) < 3 || Str\length($name) < 3) {
      $multi = SearchScores::SHORT_MATCH_MULTIPLIER;
    }

    if (Str\starts_with_ci($term, $name) || Str\starts_with_ci($name, $term)) {
      return SearchScores::PREFIX_MATCH_SCORE * $multi;
    }

    if (Str\contains_ci($name, $term)) {
      return SearchScores::SUBSTRING_MATCH_SCORE * $multi;
    }

    return null;
  }

  protected static function matchWords(
    string $name,
    string $term,
  ): ?float {
    $parts = Str\split($term, ' ');
    if (C\count($parts) === 1) {
      return null;
    }

    $total = 0.0;
    foreach ($parts as $part) {
      $score = self::matchTerm($name, $part);
      if ($score === null) {
        return null;
      }
      $total += $score;
    }
    $score = $total / C\count($parts);

    $idx = 0;
    foreach ($parts as $part) {
      $new_idx = Str\search_ci($name, $part, $idx);
      if ($new_idx === null) {
        return $score * SearchScores::OUT_OF_ORDER_WORD_SPLIT_MULTIPLIER;
      }
      $idx = $new_idx;
    }
    return $score * SearchScores::IN_ORDER_WORD_SPLIT_MULTIPLIER;
  }

  protected static function matchComponents(
    string $name,
    string $term,
  ): ?float {
    $parts = Str\split($name, '\\')
      |> Vec\map($$, $part ==> Str\split($part, '::'))
      |> Vec\flatten($$);
    if (C\count($parts) === 1) {
      return null;
    }

    $score = $parts
      |> Vec\map($$, $part ==> self::matchTerm($part, $term))
      |> Vec\filter_nulls($$)
      |> Math\max($$);

    if ($score === null) {
      return null;
    }

    return $score * SearchScores::COMPONENT_MATCH_MULTIPLIER;
  }

  protected static function matchSynonyms(string $name, string $term): ?float {
    $synonyms = self::SYNONYMS[Str\lowercase($term)] ?? null;
    if ($synonyms === null) {
      return null;
    }

    $score = $synonyms
      |> Vec\map($$, $synonym ==> self::matchTerm($name, $synonym))
      |> Vec\filter_nulls($$)
      |> Math\max($$);
    if ($score === null) {
      return null;
    }

    return $score * SearchScores::SYNONYM_MATCH_MULTIPLIER;
  }

  <<__Memoize>>
  public static function matchTerm(
    string $name,
    string $term,
  ): ?float {
    return Math\max(Vec\filter_nulls(vec[
      self::matchFullTerm($name, $term),
      self::matchWords($name, $term),
      self::matchComponents($name, $term),
      self::matchSynonyms($name, $term),
    ]));
  }
}
