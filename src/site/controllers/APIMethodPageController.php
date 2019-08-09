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

use type HHVM\UserDocumentation\{
  APIClassIndexEntry,
  APIIndex,
  APIMethodIndexEntry,
  APIProduct,
  URLBuilder,
};
use namespace HH\Lib\C;

final class APIMethodPageController extends APIPageController {
  use APIMethodPageControllerParametersTrait;

  <<__Override>>
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/')
      ->definitionType('Type')
      ->literal('/')
      ->string('Class')
      ->literal('/')
      ->string('Method')
      ->literal('/');
  }

  <<__Memoize, __Override>>
  protected function getRootDefinition(): APIClassIndexEntry {
    $this->redirectIfAPIRenamed();
    $definition_name = $this->getParameters()['Class'];
    $index = APIIndex::get($this->getParameters()['Product'])
      ->getClassIndex($this->getDefinitionType());
    if (!array_key_exists($definition_name, $index)) {
      throw new HTTPNotFoundException();
    }
    return $index[$definition_name];
  }

  <<__Memoize>>
  private function getMethodDefinition(): APIMethodIndexEntry {
    $method_name = $this->getParameters()['Method'];
    $methods = $this->getRootDefinition()['methods'];
    if (!array_key_exists($method_name, $methods)) {
      throw new HTTPNotFoundException();
    }
    return $methods[$method_name];
  }

  <<__Override>>
  public async function getTitleAsync(): Awaitable<string> {
    return $this->getRootDefinition()['name'].
      '::'.
      $this->getMethodDefinition()['name'];
  }

  <<__Override>>
  protected function getHTMLFilePath(): string {
    return $this->getMethodDefinition()['htmlPath'];
  }

  <<__Override>>
  protected function getBreadcrumbs(): vec<(string, ?string)> {
    $parameters = $this->getParameters();
    $root = $this->getRootDefinition();
    $method = $this->getMethodDefinition();

    return vec[
      Breadcrumbs::getRootAPIBreadcrumb($parameters['Product']),
      tuple(
        'Reference',
        URLBuilder::getPathForProductAPIReference($parameters['Product']),
      ),
      tuple(
        \ucwords($this->getDefinitionType()),
        APIListByTypeControllerURIBuilder::getPath(shape(
          'Product' => $parameters['Product'],
          'Type' => $parameters['Type'],
        )),
      ),
      tuple($root['name'], $root['urlPath']),
      tuple($method['name'], null),
    ];
  }
  private function redirectIfHSLAPIWithHackProduct(): void {
    $p = $this->getParameters();
    if ($p['Product'] !== APIProduct::HACK) {
      return;
    }

    $class = $p['Class'];

    $index = APIIndex::get(APIProduct::HACK)->getClassIndex($p['Type']);
    if (C\contains_key($index, $class)) {
      return;
    }

    $index = APIIndex::get(APIProduct::HSL)->getClassIndex($p['Type']);
    $class_entry = $index[$class] ?? null;
    if ($class_entry === null) {
      return;
    }
    $method_entry = $class_entry['methods'][$p['Method']] ?? null;
    if ($method_entry === null) {
      return;
    }

    throw new RedirectException($method_entry['urlPath']);
  }

  <<__Override>>
  protected function redirectIfAPIRenamed(): void {
    $this->redirectIfHSLAPIWithHackProduct();

    $redirect_to = $this->getRenamedAPI($this->getParameters()['Class']);
    if ($redirect_to === null) {
      return;
    }
    $product = $this->getParameters()['Product'];
    $type = $this->getDefinitionType();
    throw new RedirectException(
      URLBuilder::getPathForMethod($product, shape(
        'name' => $this->getParameters()['Method'],
        'className' => $redirect_to,
        'classType' => $type,
      )),
    );
  }
}
