<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

final class APIListByTypeController extends APIListController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('product')
      ->literal('/reference/')
      ->definitionType('type')
      ->literal('/');
  }

  <<__Override>>
  protected function getDefinitionTypes(): ImmSet<APIDefinitionType> {
    return ImmSet {
      APIDefinitionType::assert($this->getRequiredStringParam('type')),
    };
  }

  <<__Override>>
  protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
      'Reference' => '/hack/reference/',
    };
    $type = $this->getRequiredStringParam('type');
    return <ui:breadcrumbs parents={$parents} currentPage={ucwords($type)} />;
  }
}
