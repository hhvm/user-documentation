<?hh // strict

use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\SearchResultSet;

final class SearchController extends WebPageController {
  private string $term;
  private bool $term_set;

  public function __construct(ImmMap<string, string> $params) {
    parent::__construct($params);
    $this->term = "";
    $this->term_set = false;
  }

  protected async function getTitle(): Awaitable<string> {
    return 'Search for shit!';
  }

  private function getListFromResultSet(Map<string, string> $result_set): XHPRoot {
    $list = <ul />;
    foreach ($result_set as $name => $path) {
        $item = <li><a href={$path}>{$name}</a></li>;
        $list->appendChild($item);
    }
    if (count($result_set) === 0) {
        $item = <li><em>No results for this category</em></li>;
        $list->appendChild($item);
    }
    return $list;
  }

  protected async function getBody(): Awaitable<XHPRoot> {
    $results = $this->getSearchResults();
    return 
      <x:frag>
        You searched for "{$this->getSearchTerm()}"
        <h2>Guides</h2>
        <h3>Hack</h3>
            {$this->getListFromResultSet($results->getHackGuides())}
        <h3>HHVM</h3>
            {$this->getListFromResultSet($results->getHHVMGuides())}
        <h2>API</h2>
        <h3>Classes</h3>
            {$this->getListFromResultSet($results->getClasses())}
        <h3>Interfaces</h3>
            {$this->getListFromResultSet($results->getInterfaces())}
        <h3>Functions</h3>
            {$this->getListFromResultSet($results->getFunctions())}
      </x:frag>;
  }

  private function getSearchTerm(): string {
    if ($this->term_set) {
        return $this->term;
    }

    $this->term = ParamGetter::getGet('term');
    $this->term_set = true;

    return $this->term;
  }

  private function getSearchResults(): SearchResultSet {
    $results = new SearchResultSet();
    APIIndex::search($this->getSearchTerm(), $results);
    GuidesIndex::search($this->getSearchTerm(), $results);
    return $results;
  }
}
