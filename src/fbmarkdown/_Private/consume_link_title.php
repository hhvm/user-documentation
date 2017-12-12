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
  $idx = null;
  for ($idx = 1; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === "\n" && ($input[$idx + 1] ?? null) === "\n") {
      return null;
    }
    if ($chr === $quote) {
      break;
    }

    if ($chr === "\\") {
      if ($idx + 1 < $len) {
        $next = $input[$idx + 1];
        if (C\contains_key(ASCII_PUNCTUATION, $next)) {
          $title .= $next;
          ++$idx;
          continue;
        }
      }
    }

    if ($chr === '&') {
      $rest = Str\slice($input, $idx);
      $result = decode_html_entity($rest);
      if ($result !== null) {
        list($match, $entity, $_rest) = $result;
        $title .= $entity;
        $idx += Str\length($match) - 1;
        continue;
      }
    }

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
  for ($idx = 0; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === "\n" && ($chr[$idx + 1] ?? null) === "\n") {
      return null;
    }

    if ($chr === '(') {
      ++$depth;
      continue;
    }

    if ($chr === ')') {
      --$depth;
      if ($depth === 0) {
        break;
      }
      continue;
    }

    if ($chr === "\\") {
      if ($idx + 1 < $len) {
        $next = $input[$idx + 1];
        if (C\contains_key(ASCII_PUNCTUATION, $next)) {
          $title .= $next;
          ++$idx;
          continue;
        }
      }
    }

    $title .= $chr;
  }

  if ($depth !== 0) {
    return null;
  }

  return tuple($title, $idx + 1);
}
