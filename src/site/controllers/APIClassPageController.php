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

use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIIndexEntry;
use HHVM\UserDocumentation\APIMethodIndexEntry;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\HTMLFileRenderable;
use HHVM\UserDocumentation\URLBuilder;

use namespace HH\Lib\Str;

final class APIClassPageController extends APIPageController {
  use APIClassPageControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/')
      ->definitionType('Type')
      ->literal('/')
      ->string('Name')
      ->literal('/');
  }

  <<__Memoize,__Override>>
  protected function getRootDefinition(): APIIndexEntry {
    $this->redirectIfAPIRenamed();
    $definition_name = $this->getParameters()['Name'];

    $index = APIIndex::getIndexForType($this->getDefinitionType());
    if (!array_key_exists($definition_name, $index)) {
      throw new HTTPNotFoundException();
    }
    return $index[$definition_name];
  }

  <<__Override>>
  public async function getTitle(): Awaitable<string> {
    return Str\strip_prefix($this->getRootDefinition()['name'], "HH\\Lib\\");
  }

  <<__Override>>
  protected async function getHeading(): Awaitable<string> {
    return $this->getRootDefinition()['name'];
  }

  <<__Override>>
  protected function getHTMLFilePath(): string {
    return $this->getRootDefinition()['htmlPath'];
  }

  <<__Override>>
  protected function getSideNav(): XHPRoot {
    $path = [
      APINavData::getRootNameForType($this->getDefinitionType()),
      $this->getRootDefinition()['name'],
    ];
    return (
      <ui:navbar
        data={APINavData::getNavData()}
        activePath={$path}
        extraNavListClass="apiNavList"
      />
    );
  }

  <<__Override>>
  protected function redirectIfAPIRenamed(): void {
    $redirect_to = $this->getRenamedAPI($this->getParameters()['Name']);

    if ($redirect_to === null) {
      return;
    }

    $type = $this->getDefinitionType();
    if ($type === APIDefinitionType::FUNCTION_DEF) {
      $url = URLBuilder::getPathForFunction(shape('name' => $redirect_to));
    } else {
      $url = URLBuilder::getPathForClass(shape(
        'name' => $redirect_to,
        'type' => $type,
      ));
    }

    throw new RedirectException($url);
  }
}
