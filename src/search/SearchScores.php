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

abstract final class SearchScores {
  ///// Base scores /////

  const float EXACT_MATCH_SCORE = 100.0;
  const float PREFIX_MATCH_SCORE = 90.0;
  const float SUBSTRING_MATCH_SCORE = 1.0;
  const float HARDCODED_RESULT_SCORE = 200.0;

  ///// Penalties /////

  // e.g. search for 'map set', find HH\Map::set
  const float IN_ORDER_WORD_SPLIT_MULTIPLIER = 0.9;
  // e.g. search for 'map set', find HH\Set::map
  const float OUT_OF_ORDER_WORD_SPLIT_MULTIPLIER = 0.5;

  const float COMPONENT_MATCH_MULTIPLIER = 0.9;
  const float SYNONYM_MATCH_MULTIPLIER = 0.9;
  const float SHORT_MATCH_MULTIPLIER = 0.1;

  const float HREF_MATCH_MULTIPLIER = 0.5;
  const float CONTENT_MATCH_MULTIPLIER = 0.1;


  ///// Boosts /////

  const float HSL_API_MULTIPLIER = 2.0;
  const float GUIDES_MULTIPLIER = 1.5;
  const float GUIDES_BOOST = 10.0;
  // e.g. async/introduction before async/extensions
  const float GUIDE_INTRODUCTION_MULTIPLIER = 1.1;
};
