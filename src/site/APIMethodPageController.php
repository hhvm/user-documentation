<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIMethodIndexEntry;

final class APIMethodPageController extends APIGenericPageController {
  <<__Memoize>>
  protected function getRootDefinition(): APIClassIndexEntry {
    $definition_name = $this->getPossibleAPINameChange(
      $this->getRequiredStringParam('class')
    );
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
}
