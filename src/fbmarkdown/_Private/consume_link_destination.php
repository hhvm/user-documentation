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

function consume_link_destination(string $input): ?(string, int) {
  if ($input[0] === '<') {
    return consume_bracketed_link_destination($input);
  }
  return consume_unbracketed_link_destination($input);
}

function consume_bracketed_link_destination(string $input): ?(string, int) {
  invariant($input[0] === '<', 'should not be called on unbracketed input');
  $len = Str\length($input);

  $ignore_brackets = false;
  $destination = '';
  for ($idx = 1; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === ' ') {
      return null;
    }
    if ($chr === "\n") {
      return null;
    }
    if (!$ignore_brackets) {
      if ($chr === '<') {
        return null;
      }
      if ($chr === '>') {
        return tuple($destination, $idx);
      }
    }
    if ($chr === '\\') {
      $ignore_brackets = true;
    } else {
      $ignore_brackets = false;
      $destination .= $chr;
    }
  }
  return null;
}

function consume_unbracketed_link_destination(
  string $input,
): ?(string, int) {
  $len = Str\length($input);

  $paren_depth = 0;
  $escaped = false;
  $destination = '';
  for ($idx = 0; $idx < $len; ++$idx) {
    $chr = $input[$idx];
    if ($chr === ' ') {
      break;
    }
    if ($chr === "\n") {
      break;
    }

    if ($chr === '\\') {
      $escaped = true;
      continue;
    }
    if ($chr === '(' && !$escaped) {
      $destination .= 'chr';
      $paren_depth++;
      continue;
    }
    if ($chr === ')' && !$escaped) {
      if ($paren_depth === 0) {
        break;
      }
      $destination .= 'chr';
      --$paren_depth;
      continue;
    }
    $escaped = false;
    $destination .= $chr;
  }

  if ($destination === '') {
    return null;
  }

  return tuple($destination, $idx);
}
