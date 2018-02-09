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

use namespace HH\Lib\{C, Str};
use namespace Facebook\TypeAssert;

// Index of all definitions, so that markdown processing can
// automatically linkify them
final class UnifiedAPIIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nUnifiedAPIIndexBuildStep");

    $defs = new Map($this->getPHPAPILinks());
    $defs->setAll($this->getHackAPILinks(APIProduct::HACK));
    $defs->setAll($this->getHackAPILinks(APIProduct::HSL));
    $defs->setAll($this->getSpecialAttributeLinks());

    \file_put_contents(
      BuildPaths::UNIFIED_INDEX_JSON,
      \json_encode($defs, \JSON_PRETTY_PRINT)
    );

    $jump_index = [];
    foreach ($defs as $name => $url) {
      $name = Str\lowercase($name);
      if (
        (!C\contains_key($jump_index, $name))
        || Str\length($jump_index[$name]) > Str\length($url)
      ) {
        $jump_index[$name] = $url;
      }
    }

    $code = $this->writeCode(
      'JumpIndexData.hhi',
      $jump_index,
    );
    \file_put_contents(
      BuildPaths::JUMP_INDEX,
      $code,
    );
  }

  private function getHackAPILinks(
    APIProduct $product,
  ): ImmMap<string, string> {
    Log::v("\nProcessing %s API Index", $product);

    $out = Map { };
    $maybe_set = ($name, $url) ==> {
      if (
        (!C\contains_key($out, $name))
        || Str\length($out[$name]) > Str\length($url)
      ) {
        $out[$name] = $url;
      }
    };

    foreach (APIDefinitionType::getValues() as $type) {
      $defs = APIIndex::get($product)->getIndexForType($type);
      foreach ($defs as $_ => $def) {
        $name = $def['name'];
        $maybe_set($name, $def['urlPath']);

        $ns_pos = \strrpos($name, "\\");
        if ($ns_pos !== false) {
          $name = \substr($name, $ns_pos + 1);
          $maybe_set($name, $def['urlPath']);
        }

        if ($type === APIDefinitionType::FUNCTION_DEF) {
          continue;
        }

        $def = TypeAssert\matches_type_structure(
          type_alias_structure(APIClassIndexEntry::class),
          $def,
        );

        $methods = $def['methods'];

        foreach ($methods as $_ => $method) {
          $name = $method['className'].'::'.$method['name'];
          $maybe_set($name, $method['urlPath']);
        }
      }
    }
    return $out->toImmMap();
  }

  private function getPHPAPILinks(): ImmMap<string, string> {
    Log::v("\nProcessing PHP.net API Index");

    $index = PHPAPIIndex::getIndex();

    $out = Map { };
    foreach ($index as $name => $data) {
      $out[$name] = $data['url'];
    }

    return $out->toImmMap();
  }

  // For special attributes that don't exist in our API reference, but can be
  // used in APIs, manually add special /j/search capability
  private function getSpecialAttributeLinks(): ImmMap<string, string> {
    return ImmMap {
      '__memoize' => '/hack/attributes/special#__memoize',
      '__consistentconstruct' =>
        '/hack/attributes/special#__consistentconstruct',
      '__override' => '/hack/attributes/special#__override',
      '__deprecated' => '/hack/attributes/special#__deprecated',
      '__mockclass' => '/hack/attributes/special#__mockclass',
      '__isfoldable' => '/hack/attributes/special#__isfoldable',
      '__native' => '/hack/attributes/special#__native',
    };
  }
}
