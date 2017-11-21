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
  // Base scores
  const float EXACT_MATCH_SCORE = 100.0;
  const float PREFIX_MATCH_SCORE = 90.0;
  const float SUBSTRING_MATCH_SCORE = 50.0;

  // Penalties
  const float WORD_SPLIT_MULTIPLIER = 0.9;
  const float COMPONENT_MATCH_MULTIPLIER = 0.9;
  const float SYNONYM_MATCH_MULTIPLIER = 0.6;
  const float SHORT_MATCH_MULTIPLIER = 0.1;

  // Boosts
  const float HSL_API_MULTIPLIER = 2.0;
};
