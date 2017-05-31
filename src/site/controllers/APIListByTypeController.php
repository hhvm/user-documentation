<?hh // strict

use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\APIProduct;

final class APIListByTypeController extends WebPageController {
  use APIListByTypeControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/')
      ->definitionType('Type')
      ->literal('/');
  }

  <<__Override>>
  protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
      'Reference' => '/hack/reference/',
    };
    $type = $this->getParameters()['Type'];
    return <ui:breadcrumbs parents={$parents} currentPage={ucwords($type)} />;
  }

  <<__Override>>
  protected async function getTitle(): Awaitable<string> {
    switch ($this->getParameters()['Product']) {
      case APIProduct::HACK:
        return 'Hack APIs';
      case APIProduct::PHP:
        return 'Supported PHP APIs';
    }
  }

  <<__Override>>
  final protected async function getBody(): Awaitable<XHPRoot> {
    return
      <api-list
        product={$this->getParameters()['Product']}
        types={ImmSet{$this->getParameters()['Type']}}
      />;
  }
}
