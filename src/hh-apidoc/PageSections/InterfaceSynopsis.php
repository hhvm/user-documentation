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

use type Facebook\HHAPIDoc\DocBlock\DocBlock;
use type Facebook\DefinitionFinder\{
  ScannedBasicClass,
  ScannedClass,
  ScannedInterface,
  ScannedMethod,
  ScannedTrait,
};
use namespace HH\Lib\{Str, Vec};

class InterfaceSynopsis extends PageSection {
  public function getMarkdown(): ?string {
    $c = $this->definition;
    if (!$c instanceof ScannedClass) {
      return null;
    }

    return
      "## Interface Synopsis\n\n".
      static::getInheritanceInformation($c)."\n\n".
      static::getMethodList($c);
  }

  protected static function getMethodList(
    ScannedClass $c,
  ): string {
    return $c->getMethods()
      |> Vec\map($$, $m ==> self::getMethodListItem($c, $m))
      |> Str\join($$, "\n");
  }

  protected static function getMethodListItem(
    ScannedClass $c,
    ScannedMethod $m,
  ): string {
    $docs = DocBlock::nullable($m->getDocComment());

    $ret = $m->isStatic() ? '::' : '->';
    $ret .= $m->getName();
    $ret .= _Private\stringify_generics($m->getGenericTypes());
    $ret .= _Private\stringify_parameters(
      _Private\StringifyFormat::ONE_LINE,
      $m,
      $docs,
    );

    $rt = $m->getReturnType();
    if ($rt !== null) {
      $ret .= ': '._Private\stringify_typehint($rt);
    }

    $summary = $docs?->getSummary();

    return \sprintf(
      '- [`%s`][%s]%s',
      $ret,
      $c->getName().'::'.$m->getName(),
      $summary === null ? '' : "\\\n".$summary,
    );
  }

  protected static function getInheritanceInformation(
    ScannedClass $c,
  ): string {
    $ret = '';

    $ns = $c->getNamespaceName();
    if ($ns !== '') {
      $ret .= 'namespace '.$ns." {\n";
    }

    if ($c instanceof ScannedBasicClass) {
      $ret .= 'class ';
    } else if ($c instanceof ScannedInterface) {
      $ret .= 'interface ';
    } else if ($c instanceof ScannedTrait) {
      $ret .= 'trait ';
    } else {
      invariant_violation(
        "Don't know what a %s is.",
        get_class($c),
      );
    }

    $ret .= $c->getShortName().' ';

    if (($p = $c->getParentClassName()) !== null) {
      $ret .= 'extends '.$p.' ';
    }
    if ($interfaces = $c->getInterfaceNames()) {
      $ret .= 'implements '.Str\join($interfaces, ', ');
    }

    $ret .= ' {...}';

    if ($ns !== '') {
      $ret .= "\n}";
    }

    return "```HackSignature\n".$ret."\n```";
  }
}
