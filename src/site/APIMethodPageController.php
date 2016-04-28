<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIMethodIndexEntry;
use HHVM\UserDocumentation\URLBuilder;

final class APIMethodPageController extends APIGenericPageController {
  <<__Memoize>>
  protected function getRootDefinition(): APIClassIndexEntry {
    $this->redirectIfAPIRenamed();
    $definition_name = $this->getRequiredStringParam('class');
    $index = APIIndex::getClassIndex($this->getDefinitionType());
    if (!array_key_exists($definition_name, $index)) {
      throw new HTTPNotFoundException();
    }
    return $index[$definition_name];
  }

  <<__Memoize>>
  protected function getMethodDefinition(): APIMethodIndexEntry {
    $method_name = $this->getRequiredStringParam('method');
    $methods = $this->getRootDefinition()['methods'];
    if (!array_key_exists($method_name, $methods)) {
      throw new HTTPNotFoundException();
    }
    return $methods[$method_name];
  }

  public async function getTitle(): Awaitable<string> {
    return
      $this->getRootDefinition()['name'].
      '::'.
      $this->getMethodDefinition()['name'];
  }

  protected function getHTMLFilePath(): string {
    return $this->getMethodDefinition()['htmlPath'];
  }

  <<__Override>>
  protected function redirectIfAPIRenamed(): void {
    $redirect_to = $this->getRenamedAPI($this->getRequiredStringParam('class'));
    if ($redirect_to === null) {
      return;
    }

    $type = $this->getDefinitionType();
    throw new RedirectException(
      URLBuilder::getPathForMethod(shape(
        'name' => $this->getRequiredStringParam('method'),
        'className' => $redirect_to,
        'classType' => $type,
      )),
    );
  }
}
