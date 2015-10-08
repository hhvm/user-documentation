<?hh // strict

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\HTMLFileRenderable;

enum APIType: string as string {
  classes = 'class';
  functions = 'function';
}

final class APIPageController extends WebPageController {
  protected string $type = '';
  protected string $api = '';
  
  public function __construct(
    private ImmMap<string,string> $parameters,
  ) {
    parent::__construct($parameters);
    $this->type = $this->getRequiredStringParam('type');
    $this->api = $this->getRequiredStringParam('api');
  }
  
  protected async function getTitle(): Awaitable<string> {
    return $this->api;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    return 
      <div class="referencePageWrapper">
          {$this->getInnerContent()}
      </div>;
  }
  
  protected function getSideNav(): XHPRoot {
    $type = $this->getType();
    $classes = APIIndex::getClasses();

    $list = <ul class="navList" />;
    foreach ($classes as $class) {
      $url = sprintf(
        "/hack/reference/%s/%s/",
        $type,
        $class,
      );

      $title = ucwords(strtr($class, '-', ' '));

      $list->appendChild(
        <li>
          <h4><a href={$url}>{$title}</a></h4>
        </li>
      );
    }
    
    return
      <div class="navWrapper guideNav">
        {$list}
      </div>;
  }
  
  protected function getInnerContent(): XHPRoot {
    return self::invariantTo404(() ==> {
      $path = APIIndex::getFileForAPI(
        $this->getRequiredStringParam('type'),
        $this->getRequiredStringParam('api'),
      );
      return 
        <div>{new HTMLFileRenderable($path, BuildPaths::APIDOCS_HTML)}</div>;
    });
  }

  <<__Memoize>>
  private function getType(): APIType {
    return APIType::assert(
      $this->getRequiredStringParam('type')
    );
  }
}
