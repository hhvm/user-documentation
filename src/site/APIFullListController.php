<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

final class APIFullListController extends APIListController {
  <<__Override>>
  protected function getDefinitionTypes(): ImmSet<APIDefinitionType> {
    return new ImmSet(APIDefinitionType::getValues());
  }

  <<__Override>>
  final protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
    };
    return <ui:breadcrumbs parents={$parents} currentPage="Reference" />;
  }
}
