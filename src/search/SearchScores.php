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
  const float SUFFIX_MATCH_SCORE = 90.0;
  const float WORD_MATCH_SCORE = 90;
  const float SUBSTRING_MATCH_SCORE = 1.0;
  const float HARDCODED_RESULT_SCORE = 200.0;

  ///// Penalties /////

  // e.g. search for 'map set', find HH\Map::set
  const float IN_ORDER_WORD_SPLIT_MULTIPLIER = 0.9;
  // e.g. search for 'map set', find HH\Set::map
  const float OUT_OF_ORDER_WORD_SPLIT_MULTIPLIER = 0.5;

  const float COMPONENT_MATCH_MULTIPLIER = 0.9;
  const float SYNONYM_MATCH_MULTIPLIER = 0.5;
  const float SHORT_MATCH_MULTIPLIER = 0.1;
  // raw is length/distance
  const float LEVENSHTEIN_MULTIPLIER = 8.0;

  const float HREF_MATCH_MULTIPLIER = 0.5;
  const float CONTENT_MATCH_MULTIPLIER = 0.1;

  ///// API Reference Weights ///

  const float HSL_API_MULTIPLIER = 4.0;
  const float HACK_API_MULTIPLIER = 1.0;

  const float FUNCTION_MULTIPLIER = 1.0;
  const float METHOD_MULTIPLIER = 0.9;
  const float CLASS_MULTIPLIER = 1.2;
  const float INTERFACE_MULTIPLIER = 1.0;
  const float TRAIT_MULTIPLIER = 1.0;

  ///// Guide Weights /////

  const float GUIDES_MULTIPLIER = 1.5;
  const float GUIDES_BOOST = 5.0;
  // e.g. async/introduction before async/extensions
  const float GUIDE_INTRODUCTION_MULTIPLIER = 1.1;
};
