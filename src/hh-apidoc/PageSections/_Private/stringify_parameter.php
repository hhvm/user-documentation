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

use namespace Facebook\TypeAssert;
use namespace Facebook\HHAPIDoc\DocBlock;
use type Facebook\DefinitionFinder\ScannedParameter;
use namespace HH\Lib\{C, Str, Vec};

function stringify_parameter(
  ScannedParameter $parameter,
  ?DocBlock\ParameterInfo $docs,
): string {
  $s = '';

  $types = $docs['types'] ?? null;
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
  $s .= '$'.$parameter->getName();

  if ($parameter->isOptional()) {
    $d = TypeAssert\not_null($parameter->getDefault());
    if ($d->hasStaticValue()) {
      $s .= ' = '.\var_export($d->getStaticValue(), true);
    } else {
      $s .= ' = '.$d->getAST()->getCode();
    }
  }

  return $s;
}
