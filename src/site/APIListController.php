<?hh // strict

use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\APINavData;
use HHVM\UserDocumentation\APIDefinitionType;
use HHVM\UserDocumentation\PHPAPIIndex;

enum APIProduct: string as string {
  HACK = 'hack';
  PHP = 'php';
}

final class APIListController extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    switch ($this->getProduct()) {
      case APIProduct::HACK:
        return 'Hack APIs';
      case APIProduct::PHP:
        return 'Supported PHP APIs';
    }
  }

  private function getDefinitions(
  ): Map<APIDefinitionType, Map<string, string>> {
    switch ($this->getProduct()) {
      case APIProduct::HACK:
        return $this->getHackDefinitions();
      case APIProduct::PHP:
        return $this->getPHPDefinitions();
    }
  }

  private function getHackDefinitions(
  ): Map<APIDefinitionType, Map<string, string>> {
    $out = Map {};
    foreach (APIDefinitionType::getValues() as $type) {
      $index = APIIndex::getIndexForType($type);
      $out[$type] = Map { };
      foreach ($index as $node) {
        $out[$type][$node['name']] = $node['urlPath'];
      }
    }
    return $out;
  }

  private function getPHPDefinitions(
  ): Map<APIDefinitionType, Map<string, string>> {
    $out = Map { };

    foreach (APIDefinitionType::getValues() as $type) {
      $out[$type] = Map { };
    }

    $index = PHPAPIIndex::getIndex();
    foreach ($index as $name => $data) {
      if (!$data['supportedInHHVM']) {
        continue;
      }
      $out[$data['type']][$name] = $data['url'];
    }
    return $out->filter($map ==> $map->count() !== 0);
  }

  protected function getInnerContent(): XHPRoot {
    $defs = $this->getDefinitions();
    $type = $this->getOptionalStringParam('type');
    if ($type !== null) {
      $type = APIDefinitionType::assert($type);
      $defs = Map { $type => $defs[$type] };
    }

    $root = <div class="referenceList" />;
    foreach ($defs as $type => $api_references) {
      $title = ucwords($type.' Reference');
      $type_list = <ul class="apiList" />;
      foreach ($api_references as $name => $url) {
        $type_list->appendChild(
          <li>
            <a href={$url}>{$name}</a>
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

    if ($this->getProduct() === APIProduct::HACK) {
      return (
        <x:frag>
          <p>
            The following APIs are supported in addition to
            <a href="/php/reference/">most PHP APIs</a>.
          </p>
          {$root}
        </x:frag>
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

  protected function getBreadcrumbs(): :ui:breadcrumbs {
    $parents = Map {
      'Hack' => '/hack/',
    };
    $type = $this->getOptionalStringParam('type');
    if ($type === null) {
      $page = 'Reference';
    } else {
      $parents['Reference'] = '/hack/reference/';
      $page = ucwords($type);
    }
    return <ui:breadcrumbs parents={$parents} currentPage={$page} />;
  }

  <<__Memoize>>
  private function getProduct(): APIProduct {
    return APIProduct::assert(
      $this->getRequiredStringParam('product')
    );
  }
}
