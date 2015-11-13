<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIType;
use HHVM\UserDocumentation\HTMLFileRenderable;

use Psr\Http\Message\ServerRequestInterface;

final class APIPageController extends WebPageController {
  protected string $type;
  protected string $api;
  protected ?string $method;
  
  public function __construct(
    private ImmMap<string,string> $parameters,
    ServerRequestInterface $request,
  ) {
    parent::__construct($parameters, $request);
    $this->type = $parameters->at('type');
    $this->api = $parameters->at('api');
    $this->method = $parameters->get('method');
  }
  
  public async function getTitle(): Awaitable<string> {
    if ($this->method !== null) {
      return $this->getAPIName().'::'.$this->method;
    }
    return $this->getAPIName();
  }
  
  protected function getAPIName(): string {
    return str_replace('.', '\\', $this->api);
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="referencePageWrapper">
          {$this->getInnerContent()}
      </div>;
  }
  
  protected function getSideNav(): XHPRoot {
    $type = $this->getType();
    $guides = APIIndex::getIndex();
    return 
      <div class="navWrapper guideNav">
        <div class="navLoader"></div>
        <script>
          var docnavData = {json_encode($guides)};
          var currentMethod = "{$this->method}";
          var currentAPI = "{$this->api}";
          var currentType = "{$type}";
          var baseRefURL = "/hack/reference";
        </script>
        <script type="text/javascript" src="/js/APISideNav.js"></script>
      </div>;
  }
  
  protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = APIIndex::getFileForAPI(
        $this->type,
        $this->api,
        $this->method,
      );
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
      $this->type,
    );
 
    if ($this->method !== null) {
      $api_root_url = sprintf(
        "/%s/reference/%s/%s/",
        $product,
        $this->type,
        $this->api,
      );
      $bottom_level = 
        <x:frag>
          <span class="breadcrumbTertiaryRoot">
            <a href={$api_root_url}>{$this->getAPIName()}</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbCurrentPage">
            {$this->method}
          </span>
        </x:frag>;  
    } else {
      $bottom_level = 
        <span class="breadcrumbCurrentPage">
          {$this->getAPIName()}
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
            <a href={$type_root_url}>{$this->type}</a>
          </span>
          <i class="breadcrumbSeparator" />
          {$bottom_level}
        </div>
      </div>;
  }

  <<__Memoize>>
  private function getType(): APIType {
    return APIType::assert(
      $this->getRequiredStringParam('type')
    );
  }
}
