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

namespace Facebook\Markdown\_Private;

use namespace HH\Lib\{C, Str, Vec};

function consume_link_title(string $input): ?(string, int) {
  invariant($input !== '', "Can't consume an empty string");
  $first = $input[0];
  if ($first === '"' || $first === "'") {
    return consume_quoted_link_title($input);
  }
  if ($first === '(') {
    return consume_parenthesized_link_title($input);
  }
  return null;
}

function consume_quoted_link_title(string $input): ?(string, int) {
  $quote = $input[0];
  invariant(
    $quote === "'" || $quote === '"',
    'Should not be called without a quote',
  );
  $len = Str\length($input);

  $title = '';
  $escaped = false;
  $idx = null;
  for ($idx = 1; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === "\n" && ($input[$idx + 1] ?? null) === "\n") {
      return null;
    }
    if ($chr === $quote) {
      if ($escaped) {
        $title .= $chr;
        $escaped = false;
        continue;
      }
      break;
    }

    if ($escaped) {
      $title .= '\\';
    } else if ($chr === '\\') {
      $escaped = true;
      continue;
    }
    $escaped = false;
    $title .= $chr;
  }

  if ($idx === $len) {
    return null;
  }

  return tuple($title, $idx + 1);
}

function consume_parenthesized_link_title(string $input): ?(string, int) {
  invariant($input[0] === '(', 'must start with paren');
  $len = Str\length($input);
  $title = '';
  $depth = 0;
  $escaped = false;
  for ($idx = 0; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === "\n" && ($chr[$idx + 1] ?? null) === "\n") {
      return null;
    }

    if ($chr === '(') {
      if ($escaped) {
        $title .= $chr;
        $escaped = false;
        continue;
      }
      ++$depth;
      continue;
    }

    if ($chr === ')') {
      if ($escaped) {
        $title .= $chr;
        $escaped = false;
        continue;
      }
      --$depth;
      if ($depth === 0) {
        break;
      }
      continue;
    }

    if ($escaped) {
      $title .= '\\';
    } else if ($chr === '\\') {
      $escaped = true;
      continue;
    }
    $escaped = false;
    $title .= $chr;
  }

  if ($depth !== 0) {
    return null;
  }

  return tuple($title, $idx + 1);
}
