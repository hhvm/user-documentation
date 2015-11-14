<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APIDefinitionType;

enum APIProduct: string as string {
  HACK = 'hack';
}

final class APIListController extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    switch ($this->getProduct()) {
      case APIProduct::HACK:
        return 'Hack APIs';
    }
  }

  protected function getInnerContent(): XHPRoot {
    $type = $this->getOptionalStringParam('type');
    if ($type !== null) {
      $api_type = $type;
      $apis = Map {
        $api_type => APIIndex::getReferenceForType($api_type),
      };
    } else {
      $apis = Map {};
      foreach (APIDefinitionType::getValues() as $api_key => $api_type) {
        $apis[$api_type] = APIIndex::getReferenceForType((string) $api_type);
      }
    }

    $root = <div class="referenceList" />;
    foreach ($apis as $type => $api_references) {
      $title = ucwords($type.' Reference');
      $type_list = <ul class="apiList" />;
      foreach ($api_references as $api => $reference) {
        $url = sprintf(
          "/hack/reference/%s/%s/",
          $type,
          $api,
        );
        $type_list->appendChild(
          <li>
            <h4>
              <a href={$url}>
                {str_replace('.', '\\', $api)}
              </a>
            </h4>
          </li>
        );
      }

      $root->appendChild(
        <div class="referenceType">
          <h3 class="listTitle">{$title}</h3>
          {$type_list}
        </div>
      );
    }
    return $root;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="apiListWrapper">
        {$this->getInnerContent()}
      </div>;
  }
  
  protected function getSideNav(): XHPRoot {
    $type = $this->getOptionalStringParam('type');
    $guides = APIIndex::getIndex();
    return 
      <div class="navWrapper guideNav">
        <div class="navLoader"></div>
        <script>
          var docnavData = {json_encode($guides)};
          var currentMethod = "";
          var currentAPI = "";
          var currentType = "{$type}";
          var baseRefURL = "/hack/reference";
        </script>
        <script type="text/babel" src="/js/APISideNav.js"></script>
      </div>;
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
    
    $breadcrumbs =
      <x:frag>
        <span class="breadcrumbRoot">
          <a href="/">Documentation</a>
        </span>
        <i class="breadcrumbSeparator" />
        <span class="breadcrumbProductRoot">
          <a href={$product_root_url}>{$product}</a>
        </span>
      </x:frag>;
      
    $type = $this->getOptionalStringParam('type');
    if ($type !== null) {
      $breadcrumbs->appendChild(
        <x:frag>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbSecondaryRoot">
            <a href={$reference_root_url}>Reference</a>
          </span>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbTypeRoot breadcrumbCurrentPage">
            {$type}
          </span>
        </x:frag>
      );
    } else {
      $breadcrumbs->appendChild(
        <x:frag>
          <i class="breadcrumbSeparator" />
          <span class="breadcrumbSecondaryRoot breadcrumbCurrentPage">
            Reference
          </span>
        </x:frag>
      );
    }
    
    return 
      <div class="breadcrumbNav">
        <div class="widthWrapper">
          {$breadcrumbs}
        </div>
      </div>;
  }

  <<__Memoize>>
  private function getProduct(): APIProduct {
    return APIProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
