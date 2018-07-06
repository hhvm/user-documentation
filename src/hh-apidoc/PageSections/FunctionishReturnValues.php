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

namespace Facebook\HHAPIDoc\PageSections;

use namespace Facebook\HHAPIDoc\DocBlock;
use type Facebook\DefinitionFinder\ScannedFunctionish;

use namespace HH\Lib\{C, Vec, Str};

class FunctionishReturnValues extends PageSection {
  <<__Override>>
  public function getMarkdown(): ?string {
    $f = $this->definition;
    if (!$f instanceof ScannedFunctionish) {
      return null;
    }

    $values = $this->docBlock?->getReturnInfo() ?? vec[];
    if (C\is_empty($values)) {
      return null;
    }

    return $values
      |> Vec\map($$, $v ==> self::getReturnValueInformation($f, $v))
      |> Str\join($$, "\n")
      |> "## Return Values\n\n".$$;
  }

  protected static function getReturnValueInformation(
    ScannedFunctionish $f,
    DocBlock\ReturnInfo $docs,
  ): string {
    $ret = '- ';

    $types = Vec\filter(
      $docs['types'],
      $type ==> $type !== '\-' && $type !== '-',
    );
    if ($types) {
      $ret .= '`'.Str\join($types, '|').'` - ';
    } else if ($type = $f->getReturnType()) {
      $ret .= '`'._Private\stringify_typehint($type).'` - ';
    }
    $ret .= $docs['text'];
    return $ret;
  }
}
