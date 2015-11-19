<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\SearchResultSet;

use Psr\Http\Message\ServerRequestInterface;

final class SearchController extends WebPageController {
  public async function getTitle(): Awaitable<string> {
    return "Search results for '{$this->getSearchTerm()}':";
  }

  private function getListFromResultSet(Map<string, string> $result_set): XHPRoot {
    if (count($result_set) === 0) {
      $list = <div><p><em>No Results Found</em></p></div>;
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
    return 
      <x:frag>
        <h2>Guides</h2>
        <h3>Hack</h3>
        {$this->getListFromResultSet($results->getHackGuides())}
        <h3>HHVM</h3>
        {$this->getListFromResultSet($results->getHHVMGuides())}
        <h2>API</h2>
        <h3>Classes</h3>
        {$this->getListFromResultSet($results->getClasses())}
        <h3>Traits</h3>
        {$this->getListFromResultSet($results->getTraits())}
        <h3>Interfaces</h3>
        {$this->getListFromResultSet($results->getInterfaces())}
        <h3>Functions</h3>
        {$this->getListFromResultSet($results->getFunctions())}
      </x:frag>;
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
