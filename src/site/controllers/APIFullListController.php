<?hh // strict

use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\APIProduct;

final class APIFullListController extends WebPageController {
  use APIFullListControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/');
  }

  <<__Override>>
  final protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
    };
    return <ui:breadcrumbs parents={$parents} currentPage="Reference" />;
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
        types={new ImmSet(APIDefinitionType::getValues())}
      />;
  }
}
