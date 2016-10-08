<?hh // strict

use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIIndexEntry;
use HHVM\UserDocumentation\APIMethodIndexEntry;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\HTMLFileRenderable;
use HHVM\UserDocumentation\URLBuilder;

abstract class APIPageController extends WebPageController {
  <<__Memoize>>
  final protected function getDefinitionType(): APIDefinitionType {
    return $this->getParameters_PRIVATE_IMPL()->getEnum(
      APIDefinitionType::class,
      'Type',
    );
  }

  abstract protected function getRootDefinition(): APIIndexEntry;

  final protected async function getBody(): Awaitable<XHPRoot> {
    return
      <div class="referencePageWrapper">
          {$this->getInnerContent()}
      </div>;
  }

  abstract protected function getHTMLFilePath(): string;

  final protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = $this->getHTMLFilePath();
      return
        <div class="innerContent">
          {new HTMLFileRenderable($path, BuildPaths::APIDOCS_HTML)}
        </div>;
    });
  }

  abstract protected function redirectIfAPIRenamed(): void;

  final protected function getRenamedAPI(string $old): ?string {
    $change_map = ImmMap {
      'ImmMap' => 'HH.ImmMap',
      'ImmSet' => 'HH.ImmSet',
      'ImmVector' => 'HH.ImmVector',
      'Map' => 'HH.Map',
      'Pair' => 'HH.Pair',
      'Set' => 'HH.Set',
      'Vector' => 'HH.Vector',
    };

    return $change_map[$old] ?? null;
  }
}
