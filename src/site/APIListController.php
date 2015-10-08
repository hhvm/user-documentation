<?hh // strict

use HHVM\UserDocumentation\APIIndex;

enum APIProduct: string as string {
  HACK = 'hack';
}

final class APIListController extends WebPageController {
  protected async function getTitle(): Awaitable<string> {
    switch ($this->getProduct()) {
      case APIProduct::HACK:
        return 'Hack APIs';
    }
  }
  
  protected function getInnerContent(): XHPRoot {
    $classes = APIIndex::getClasses();

    $root = <ul class="classList" />;
    foreach ($classes as $class) {
      $url = sprintf(
        "/hack/reference/class/%s/",
        $class,
      );

      $title = ucwords(strtr($class, '-', ' '));

      $root->appendChild(
        <li>
          <h4><a href={$url}>{$title}</a></h4>
          <div class="apiDescription">
          </div>
        </li>
      );
    }
    return $root;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="apiListWrapper">
        <h3 class="listTitle">Reference</h3>
        {$this->getInnerContent()}
      </div>;
  }

  <<__Memoize>>
  private function getProduct(): APIProduct {
    return APIProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
