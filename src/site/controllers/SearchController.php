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

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, li, p, span, ul};
use type Facebook\HackRouter\{
  StringRequestParameter,
  StringRequestParameterSlashes,
};
use type HHVM\UserDocumentation\{
  APIIndex,
  GuidePageSearchResult,
  GuidesIndex,
  GuidesProduct,
  SearchResult,
  SearchScores,
};


use namespace HH\Lib\{C, Str, Vec};

final class SearchController extends WebPageController {
  use SearchControllerParametersTrait;

  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/search');
  }

  <<__Override>>
  protected static function getExtraParametersSpec(
  ): self::TParameterDefinitions {
    return shape(
      'required' => ImmVector {
        new StringRequestParameter(
          StringRequestParameterSlashes::ALLOW_SLASHES,
          'term',
        ),
      },
      'optional' => ImmVector {},
    );
  }

  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    return "Search results for '{$this->getSearchTerm()}':";
  }

  <<__Override>>
  protected async function getBodyAsync(): Awaitable<x\node> {
    $search_results = $this->getSearchResults();

    if (C\is_empty($search_results)) {
      return (
        <div class="innerContent">
          <p>No results found.</p>
        </div>
      );
    }

    $results = Vec\map(
      $search_results,
      $result ==>
        <li data-search-score={sprintf('%.2f', $result->getScore())}>
          <a href={$result->getHref()}>{$result->getTitle()}</a>
          <span class="searchResultType">{$result->getResultTypeText()}</span>
        </li>,
    );

    return (
      <div class="innerContent">
        <ul class="searchResults">{$results}</ul>
      </div>
    );
  }

  <<__Memoize>>
  private function getSearchTerm(): string {
    return $this->getParameters()['term'];
  }

  private function getSearchResults(): vec<SearchResult> {
    $term = $this->getSearchTerm();
    $results = vec[
      $this->getHardcodedResults(),
      GuidesIndex::search($term),
      APIIndex::searchAllProducts($term),
    ]
      |> Vec\flatten($$)
      |> Vec\sort_by($$, $result ==> -($result->getScore()));

    if (C\count($results) < 5) {
      return $results;
    }

    $max = $results[0]->getScore();
    return Vec\filter($results, $r ==> $r->getScore() >= 0.3 * $max);
  }

  private function getHardcodedResults(): vec<SearchResult> {
    $term = Str\lowercase($this->getSearchTerm());

    $hack_array_keywords = keyset[
      'vec',
      'dict',
      'keyset',
      'vector',
      'immvector',
      'constvector',
      'map',
      'immmap',
      'constmap',
      'set',
      'immset',
      'constset',
    ];
    if (!C\contains_key($hack_array_keywords, $term)) {
      return vec[];
    }

    return vec[
      new GuidePageSearchResult(
        GuidesProduct::HACK,
        'types',
        'arrays',
        SearchScores::HARDCODED_RESULT_SCORE,
      ),
    ];
  }
}
