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

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, h3, li, ul};
use type HHVM\UserDocumentation\{APIDefinitionType, APIIndex, APIProduct};

use namespace HH\Lib\{C, Str};

xhp class api_list extends x\element {
  attribute
    APIProduct product @required,
    ImmSet<APIDefinitionType> types @required;

  final private function getDefinitions(
  ): Map<APIDefinitionType, Map<string, (string, bool)>> {
    switch ($this->:product) {
      case APIProduct::HACK:
      case APIProduct::HSL:
      case APIProduct::HSL_EXPERIMENTAL:
        return $this->getHackDefinitions($this->:product);
    }
  }

  final private function getHackDefinitions(
    APIProduct $product,
  ): Map<APIDefinitionType, Map<string, (string, bool)>> {
    $out = Map {};
    foreach ($this->:types as $type) {
      $index = APIIndex::get($product)->getIndexForType($type);
      $out[$type] = Map {};
      foreach ($index as $node) {
        $out[$type][$node['name']] = tuple(
          $node['urlPath'],
          $type === APIDefinitionType::FUNCTION_DEF && ($node as APIFunctionIndexEntry)['deprecation'] !== null
        );
      }
    }
    return $out;
  }

  final private function getInnerContent(): x\node {
    $defs = $this->getDefinitions();

    $root = <div class="referenceList" />;
    foreach ($defs as $type => $api_references) {
      if (C\is_empty($api_references)) {
        continue;
      }
      $title = \ucwords($type.' Reference');
      $type_list = <ul class="apiList" />;
      foreach ($api_references as $name => list($url, $deprecated)) {
        $name = $name
          |> Str\strip_prefix($$, "HH\\Lib\\Experimental\\")
          |> Str\strip_prefix($$, "HH\\Lib\\");
        $type_list->appendChild(
          <li>
            <a href={$url} class={$deprecated ? 'deprecated' : null}>{$name}</a>
          </li>,
        );
      }

      $root->appendChild(
        <div class="referenceType">
          <h3 class="listTitle">{$title}</h3>
          {$type_list}
        </div>,
      );
    }

    return $root;
  }

  <<__Override>>
  final protected async function renderAsync(): Awaitable<x\node> {
    return
      <div class="apiListWrapper">
        {$this->getInnerContent()}
      </div>;
  }
}
