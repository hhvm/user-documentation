<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

final class APIFullListController extends APIListController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/')
      ->apiProduct('Product')
      ->literal('/reference/');
  }

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
