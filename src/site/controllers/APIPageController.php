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

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\div;
use type HHVM\UserDocumentation\{
  APIDefinitionType,
  APIIndexEntry,
  BuildPaths,
  HTMLFileRenderable,
};

abstract class APIPageController extends WebPageController {
  <<__Memoize>>
  final protected function getDefinitionType(): APIDefinitionType {
    return $this->getParameters_PRIVATE_IMPL()
      ->getEnum(APIDefinitionType::class, 'Type');
  }

  abstract protected function getRootDefinition(): APIIndexEntry;

  <<__Override>>
  final protected async function getBodyAsync(): Awaitable<x\node> {
    return
      <div class="referencePageWrapper">
        {$this->getInnerContent()}
      </div>;
  }

  abstract protected function getHTMLFilePath(): string;

  final protected function getInnerContent(): x\node {
    return self::invariantTo404(() ==> {
      $path = $this->getHTMLFilePath();
      return
        <div class="innerContent">
          {new HTMLFileRenderable($path, BuildPaths::APIDOCS_HTML)}
        </div>;
    });
  }

  abstract protected function redirectIfAPIRenamed(): void;

  final protected function getRenamedAPI(string $old): ?string {
    $change_map = ImmMap {
      'ImmMap' => 'HH.ImmMap',
      'ImmSet' => 'HH.ImmSet',
      'ImmVector' => 'HH.ImmVector',
      'Map' => 'HH.Map',
      'Pair' => 'HH.Pair',
      'Set' => 'HH.Set',
      'Vector' => 'HH.Vector',
    };

    return $change_map[$old] ?? null;
  }
}
