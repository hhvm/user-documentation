<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIType;
use HHVM\UserDocumentation\HTMLFileRenderable;

final class APIPageController extends WebPageController {
  protected string $type = '';
  protected string $api = '';
  protected ?string $method;
  
  public function __construct(
    private ImmMap<string,string> $parameters,
  ) {
    parent::__construct($parameters);
    $this->type = $this->getRequiredStringParam('type');
    $this->api = $this->getRequiredStringParam('api');
    $this->method = $this->getOptionalStringParam('method');
  }
  
  protected async function getTitle(): Awaitable<string> {
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
    $type = (string) $this->getType();
    $title = ucwords($type.' Reference');    
    $apis = APIIndex::getReferenceForType($type);
    $sub_list = <ul class="subList" />;
    $parent_type_url = sprintf(
      "/hack/reference/%s/",
      $type,
    );
    
    foreach ($apis as $api => $page) {
      $item_url = sprintf(
        "/hack/reference/%s/%s/",
        $type,
        $api,
      );

      $sub_list_item =
        <li class="subListItem">
          <h5 id={$api}>
            <a href={$item_url}>
              {str_replace('.', '\\', $api)}
            </a>
          </h5>
        </li>;
          
      if ($this->api === $api) {
        $sub_list_item->addClass("itemActive");
      }
      
      $sub_list->appendChild($sub_list_item);
    }
    
    $type_list = <x:frag />;
    
    foreach (APIType::getValues() as $api_type) {    
      $type_url = sprintf(
        "/hack/reference/%s/",
        $api_type,
      );
      $type_title = ucwords($api_type.' Reference');    
      if ($api_type !== $type) {
        $type_list->appendChild(
          <li><h4><a href={$type_url}>{$type_title}</a></h4></li>
        );
      }
    }

    return
      <div class="navWrapper guideNav">
        <ul class="navList apiNavList">
          <li>
            <h4><a href={$parent_type_url}>{$title}</a></h4>
            {$sub_list}
          </li>
          {$type_list}
        </ul>
      </div>;
    return <x:frag />;
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
