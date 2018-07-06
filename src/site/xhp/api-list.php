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

use type HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use type HHVM\UserDocumentation\APIDefinitionType;
use type HHVM\UserDocumentation\APIProduct;
use type HHVM\UserDocumentation\PHPAPIIndex;

use namespace HH\Lib\C;

class :api-list extends :x:element {
  attribute
    APIProduct product @required,
    ImmSet<APIDefinitionType> types @required;

  final private function getDefinitions(
  ): Map<APIDefinitionType, Map<string, string>> {
    switch ($this->:product) {
      case APIProduct::HACK:
      case APIProduct::HSL:
        return $this->getHackDefinitions($this->:product);
      case APIProduct::PHP:
        return $this->getPHPDefinitions();
    }
  }

  final private function getHackDefinitions(
    APIProduct $product,
  ): Map<APIDefinitionType, Map<string, string>> {
    $out = Map {};
    foreach ($this->:types as $type) {
      $index = APIIndex::get($product)->getIndexForType($type);
      $out[$type] = Map { };
      foreach ($index as $node) {
        $out[$type][$node['name']] = $node['urlPath'];
      }
    }
    return $out;
  }

  final private function getPHPDefinitions(
  ): Map<APIDefinitionType, Map<string, string>> {
    $out = Map { };

    foreach ($this->:types as $type) {
      $out[$type] = Map { };
    }

    $index = PHPAPIIndex::getIndex();
    foreach ($index as $name => $data) {
      if (!$data['supportedInHHVM']) {
        continue;
      }
      if (!$this->:types->contains($data['type'])) {
        continue;
      }
      $out[$data['type']][$name] = $data['url'];
    }
    return $out->filter($map ==> $map->count() !== 0);
  }

  final private function getInnerContent(): XHPRoot {
    $defs = $this->getDefinitions();

    $root = <div class="referenceList" />;
    foreach ($defs as $type => $api_references) {
      if (C\is_empty($api_references)) {
        continue;
      }
      $title = ucwords($type.' Reference');
      $type_list = <ul class="apiList" />;
      foreach ($api_references as $name => $url) {
        $type_list->appendChild(
          <li>
            <a href={$url}>{$name}</a>
          </li>
        );
      }

      $root->appendChild(
        <div class="referenceType">
          <h3 class="listTitle">{$title}</h3>
          {$type_list}
        </div>
      );
    }

    if ($this->:product === APIProduct::HACK) {
      return (
        <x:frag>
          <p>
            The following APIs are supported in addition to
            <a href="/php/reference/">most PHP APIs</a>.
          </p>
          {$root}
        </x:frag>
      );
    }

    return $root;
  }

  final protected function render(): XHPRoot {
    return
      <div class="apiListWrapper">
        {$this->getInnerContent()}
      </div>;
  }
}
