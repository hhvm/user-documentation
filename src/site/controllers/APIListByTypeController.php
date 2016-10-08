<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

final class APIListByTypeController extends APIListController {
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
  protected function getDefinitionTypes(): ImmSet<APIDefinitionType> {
    return ImmSet { $this->getParameters()->getType() };
  }

  <<__Override>>
  protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
      'Reference' => '/hack/reference/',
    };
    $type = $this->getParameters()->getType();
    return <ui:breadcrumbs parents={$parents} currentPage={ucwords($type)} />;
  }
}
