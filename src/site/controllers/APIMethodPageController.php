<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIMethodIndexEntry;
use HHVM\UserDocumentation\URLBuilder;

final class APIMethodPageController extends APIPageController {
  use APIMethodPageControllerParametersTrait;

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

  <<__Memoize,__Override>>
  protected function getRootDefinition(): APIClassIndexEntry {
    $this->redirectIfAPIRenamed();
    $definition_name = $this->getParameters()['Class'];
    $index = APIIndex::getClassIndex($this->getDefinitionType());
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
  public async function getTitle(): Awaitable<string> {
    return
      $this->getRootDefinition()['name'].
      '::'.
      $this->getMethodDefinition()['name'];
  }

  <<__Override>>
  protected function getHTMLFilePath(): string {
    return $this->getMethodDefinition()['htmlPath'];
  }

  <<__Override>>
  protected function getBreadcrumbs(): :ui:breadcrumbs {
    $root = $this->getRootDefinition();
    $type = $this->getDefinitionType();
    $parents = Map {
      'Hack' => '/hack/',
      'Reference' => '/hack/reference/',
      ucwords($type) => '/hack/reference/'.$type.'/',
      $root['name'] => $root['urlPath'],
    };

    $page = $this->getMethodDefinition()['name'];

    return <ui:breadcrumbs parents={$parents} currentPage={$page} />;
  }

  <<__Override>>
  protected function redirectIfAPIRenamed(): void {
    $redirect_to = $this->getRenamedAPI($this->getParameters()['Class']);
    if ($redirect_to === null) {
      return;
    }
    $type = $this->getDefinitionType();
    throw new RedirectException(
      URLBuilder::getPathForMethod(shape(
        'name' => $this->getParameters()['Method'],
        'className' => $redirect_to,
        'classType' => $type,
      )),
    );
  }
}
