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

namespace Facebook\HHAPIDoc\PageSections\_Private;

use type Facebook\HHAPIDoc\DocBlock\DocBlock;
use type Facebook\DefinitionFinder\ScannedParameter;
use namespace HH\Lib\{C, Str, Vec};

function stringify_parameter(
  ScannedParameter $parameter,
  ?DocBlock $function_docs,
): string {
  $s = '';

  $param_info =
    $function_docs?->getParameterInfo()[$parameter->getName()] ?? null;
  $types = $param_info['types'] ?? null;
  if ($types) {
    $s .= Str\join($types, '|').' ';
  } else if ($th = $parameter->getTypehint()) {
    $s .= stringify_typehint($th).' ';
  }

  if ($parameter->isVariadic()) {
    $s .= '...';
  }
  if ($parameter->isPassedByReference()) {
    $s .= '&';
  }
  $s .= $parameter->getName();

  if ($parameter->isOptional()) {
    $s .= ' = '.$parameter->getDefaultString();
  }

  return $s;
}
