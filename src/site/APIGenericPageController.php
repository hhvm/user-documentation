<?hh // strict

use HHVM\UserDocumentation\APIClassIndexEntry;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIIndexEntry;
use HHVM\UserDocumentation\APILegacyIndexEntry;
use HHVM\UserDocumentation\APILegacyIndexShape;
use HHVM\UserDocumentation\APIMethodIndexEntry;
use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\HTMLFileRenderable;

class APIGenericPageController extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return $this->getRootDefinition()['name'];
  }

  <<__Memoize>>
  final protected function getDefinitionType(): APIDefinitionType {
    return APIDefinitionType::assert(
      $this->getRequiredStringParam('type')
    );
  }

  <<__Memoize>>
  protected function getRootDefinition(): APIIndexEntry {
    $definition_name = $this->getRequiredStringParam('name');
    return APIIndex::getIndexForType($this->getDefinitionType())[$definition_name];
  }
  
  final protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="referencePageWrapper">
          {$this->getInnerContent()}
      </div>;
  }

  protected function getMethodDefinition(): ?APIMethodIndexEntry {
    return null;
  }

  private static function makeLegacyIndex(): APILegacyIndexShape {
    return shape(
      'class' =>
        array_map(
          $class ==> self::makeLegacyIndexEntryForClass($class),
          APIIndex::getClassIndex(APIDefinitionType::CLASS_DEF),
        ),
      'interface' =>
        array_map(
          $class ==> self::makeLegacyIndexEntryForClass($class),
          APIIndex::getClassIndex(APIDefinitionType::INTERFACE_DEF),
        ),
      'trait' =>
        array_map(
          $class ==> self::makeLegacyIndexEntryForClass($class),
          APIIndex::getClassIndex(APIDefinitionType::TRAIT_DEF),
        ),
      'function' =>
        array_map(
          $fun ==> shape('path' => basename($fun['htmlPath']), 'methods' => []),
          APIIndex::getFunctionIndex(),
        ),
    );
  }

  private static function makeLegacyIndexEntryForClass(
    APIClassIndexEntry $class,
  ): APILegacyIndexEntry {
    return shape(
      'path' => basename($class['htmlPath']),
      'methods' => array_map($m ==> basename($m['htmlPath']), $class['methods']),
    );
  }

  protected function getSideNav(): XHPRoot {
    $method = $this->getMethodDefinition();

    $index = self::makeLegacyIndex();
    return 
      <div class="navWrapper guideNav">
        <div class="navLoader"></div>
        <script>
          var docnavData = {json_encode($index)};
          var currentMethod = {json_encode($method ? $method['name'] : '')};
          var currentAPI = {json_encode(
            strtr($this->getRootDefinition()['name'], "\\", "."))};
          var currentType = {json_encode($this->getDefinitionType())};
          var baseRefURL = "/hack/reference";
        </script>
        <script type="text/javascript" src="/js/APISideNav.js"></script>
      </div>;
  }

  protected function getHTMLFilePath(): string {
    return $this->getRootDefinition()['htmlPath'];
  }
  
  final protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = $this->getHTMLFilePath();
      return 
        <div class="innerContent">
          {new HTMLFileRenderable($path, BuildPaths::APIDOCS_HTML)}
        </div>;
    });
  }
  
  protected function getBreadcrumbs(): XHPRoot {
    $product = 'hack';
    $product_root_url = sprintf(
      "/%s/",
      $product,
    );
    $reference_root_url = sprintf(
      "/%s/reference/",
      $product,
    );
    $type_root_url = sprintf(
      "/%s/reference/%s/",
      $product,
      $this->getDefinitionType(),
    );

    $method = $this->getMethodDefinition();
    if ($method !== null) {
      $api_root_url = sprintf(
        "/%s/reference/%s/%s/",
        $product,
        $this->getDefinitionType(),
        $this->getRootDefinition()['name'],
      );
      $bottom_level = 
        <x:frag>
          <span class="breadcrumbTertiaryRoot">
            <a href={$api_root_url}>{$this->getRootDefinition()['name']}</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbCurrentPage">
            {$method['name']}
          </span>
        </x:frag>;  
    } else {
      $bottom_level = 
        <span class="breadcrumbCurrentPage">
          {$this->getRootDefinition()['name']}
        </span>;  
    }
    
    return
      <div class="breadcrumbNav">
        <div class="widthWrapper">
          <span class="breadcrumbRoot">
            <a href="/">Documentation</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbProductRoot">
            <a href={$product_root_url}>{$product}</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbSecondaryRoot">
            <a href={$reference_root_url}>Reference</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbTypeRoot">
            <a href={$type_root_url}>{$this->getDefinitionType()}</a>
          </span>
          <i class="breadcrumbSeparator" />
          {$bottom_level}
        </div>
      </div>;
  }
}
