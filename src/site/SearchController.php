<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\SearchResultSet;

use Psr\Http\Message\ServerRequestInterface;

final class SearchController extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return "Search results for '{$this->getSearchTerm()}':";
  }

  private function getListFromResultSet(
    Map<string, string> $result_set,
  ): ?XHPRoot {
    if (count($result_set) === 0) {
      return null;
    } else {
      $list = <ul />;
      foreach ($result_set as $name => $path) {
        $item = <li><a href={$path}>{$name}</a></li>;
        $list->appendChild($item);
      }
    }
    return $list;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    $results = $this->getSearchResults();

    $result_lists = (Map {
      'Hack Guides' => $results->getHackGuides(),
      'HHVM Guides' => $results->getHackGuides(),
      'Hack Classes' => $results->getClasses(),
      'Hack Traits' => $results->getTraits(),
      'Hack Interfaces' => $results->getInterfaces(),
      'Hack Functions' => $results->getFunctions(),
    })
      ->map($defs ==>$this->getListFromResultSet($defs))
      ->filter($xhp ==> $xhp !== null);

    if (!$result_lists) {
      return <p>No results found.</p>;
    }

    $root = <div class="innerContent" />;
    foreach ($result_lists as $type => $list) {
      $root->appendChild(
        <x:frag>
          <h1>{$type}</h1>
          {$list}
        </x:frag>
      );
    }
    return $root;
  }

  <<__Memoize>>
  private function getSearchTerm(): string {
    return $this->getRequiredStringParam('term');
  }

  private function getSearchResults(): SearchResultSet {
    return ((new SearchResultSet())
      ->addAll(APIIndex::search($this->getSearchTerm()))
      ->addAll(GuidesIndex::search($this->getSearchTerm()))
    );
  }
}
