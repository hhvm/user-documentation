<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

final class APIListByTypeController extends APIListController {
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
