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

use namespace HH\Lib\{C, Keyset, Math, Str, Vec};
use namespace Facebook\TypeAssert;

abstract final class SearchTermMatcher {
  const dict<string, keyset<string>> SYNONYMS = dict[
    'vec' => keyset['c'],
    'dict' => keyset['c'],
    'keyset' => keyset['c'],
    'vector' => keyset['vec'],
    'map' => keyset['dict'],
    'set' => keyset['keyset'],
    'string' => keyset['str'],
    'varray' => keyset['vec'],
    'darray' => keyset['dict'],
    'array' => keyset['dict', 'keyset', 'vec'],
  ];

  protected static function matchFullTerm(
    string $content,
    string $term,
  ): ?float {
    if (Str\length($term) === 0) {
      return null;
    }

    if ($term === $content) {
      return SearchScores::EXACT_MATCH_SCORE;
    }

    if (Str\contains($term, ' ')) {
      return null;
    }

    $multi = 1.0;
    if (Str\length($term) < 3 || Str\length($content) < 3) {
      $multi = SearchScores::SHORT_MATCH_MULTIPLIER;
    }

    if (Str\starts_with($content, $term)) {
      return SearchScores::PREFIX_MATCH_SCORE * $multi;
    }
    if (Str\ends_with($content, $term)) {
      return SearchScores::SUFFIX_MATCH_SCORE * $multi;
    }

    if (Str\contains($content, $term)) {
      return SearchScores::SUBSTRING_MATCH_SCORE * $multi;
    }

    return null;
  }

  protected static function matchWords(
    string $content,
    string $term,
    keyset<string> $terms,
  ): ?float {
    $parts = Str\split($term, ' ');
    if (C\count($parts) === 1) {
      return null;
    }

    $terms = Keyset\union($terms, $parts);

    $total = 0.0;
    foreach ($parts as $idx => $part) {
      $score = self::matchTermInner($content, $part, $terms);
      if ($score === null) {
        return null;
      }
      $total += $score;
    }
    $score = $total / C\count($parts);

    $idx = 0;
    foreach ($parts as $part) {
      $new_idx = $part
        |> Keyset\union(
          vec[$$],
          self::SYNONYMS[Str\lowercase($$)] ?? vec[],
        )
        |> Vec\map($$, $part ==> Str\search($content, $part, $idx + 1))
        |> Vec\filter_nulls($$)
        |> Math\min($$);
      if ($new_idx === null) {
        return $score * SearchScores::OUT_OF_ORDER_WORD_SPLIT_MULTIPLIER;
      }
      $idx = $new_idx;
    }
    return $score * SearchScores::IN_ORDER_WORD_SPLIT_MULTIPLIER;
  }

  protected static function matchComponents(
    string $content,
    string $term,
    keyset<string> $terms,
  ): ?float {
    $parts = Str\split($content, '\\')
      |> Vec\map($$, $part ==> Str\split($part, '::'))
      |> Vec\flatten($$);
    if (C\count($parts) === 1) {
      return null;
    }

    $terms = Keyset\union($terms, $parts);

    $score = $parts
      |> Vec\map($$, $part ==> self::matchTermInner($part, $term, $terms))
      |> Vec\filter_nulls($$)
      |> Math\max($$);

    if ($score === null) {
      return null;
    }

    return $score * SearchScores::COMPONENT_MATCH_MULTIPLIER;
  }

  protected static function matchSynonyms(
    string $content,
    string $term,
    keyset<string> $terms,
  ): ?float {
    $synonyms = self::SYNONYMS[Str\lowercase($term)] ?? null;
    if ($synonyms === null) {
      return null;
    }

    $synonyms = Keyset\filter($synonyms, $s ==> !C\contains_key($terms, $s));
    $terms = Keyset\union($terms, $synonyms);

    $score = $synonyms
      |> Vec\map($$, $synonym ==> {
        return self::matchTermInner($content, $synonym, $terms);
      })
      |> Vec\filter_nulls($$)
      |> Math\max($$);
    if ($score === null) {
      return null;
    }

    return $score * SearchScores::SYNONYM_MATCH_MULTIPLIER;
  }

  <<__Memoize>>
  public static function matchTerm(
    string $content,
    string $term,
  ): ?float {
    $content = Str\lowercase($content);
    $term = Str\lowercase($term);
    return self::matchTermInner($content, $term, keyset[$term]);
  }

  protected static function matchTermInner(
    string $content,
    string $term,
    keyset<string> $terms,
  ): ?float {
    $matches = vec[
      self::matchFullTerm($content, $term),
      self::matchWords($content, $term, $terms),
      self::matchSynonyms($content, $term, $terms),
    ];

    if (Str\length($content) < 80) {
      // Don't try these on long-form content
      $matches = Vec\concat(
        $matches,
        vec[
          self::matchComponents($content, $term, $terms),
          self::matchEditDistance($content, $term),
        ],
      );
    }
    return Math\max(Vec\filter_nulls($matches));
  }

  protected static function matchEditDistance(
    string $content,
    string $term,
  ): ?float {
    if ($content === $term) {
      return null;
    }

    $length = Math\minva(
      Str\length($content),
      Str\split($term, ' ')
        |> Vec\map($$, $word ==> Str\length($word))
        |> Math\max($$)
        |> TypeAssert\not_null($$)
      ,
    );
    $diff = \levenshtein($content, $term);
    if ($diff >= Math\minva($length, 3)) {
      return null;
    }
    if ($diff === -1) {
      return null;
    }

    return ((float) $length) / ((float) $diff)
      * SearchScores::LEVENSHTEIN_MULTIPLIER;
  }
}
