<?hh // strict

use FredEmmott\HackRouter\StringRequestParameter;
use FredEmmott\HackRouter\StringRequestParameterSlashes;
use HHVM\UserDocumentation\APIIndex;
use HHVM\UserDocumentation\GuidesIndex;
use HHVM\UserDocumentation\PHPAPIIndex;
use HHVM\UserDocumentation\SearchResultSet;

use Psr\Http\Message\ServerRequestInterface;

final class SearchController extends WebPageController {
  use SearchControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/search');
  }

  <<__Override>>
  protected static function getExtraParametersSpec(
  ): self::TParameterDefinitions {
    return shape(
      'required' => ImmVector {
        new StringRequestParameter(
          StringRequestParameterSlashes::ALLOW_SLASHES,
          'term',
        ),
      },
      'optional' => ImmVector { },
    );
  }

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
      'HHVM Guides' => $results->getHHVMGuides(),
      'Hack Classes' => $results->getHackClasses(),
      'Hack Traits' => $results->getHackTraits(),
      'Hack Interfaces' => $results->getHackInterfaces(),
      'Hack Functions' => $results->getHackFunctions(),
      'PHP Classes' => $results->getPHPClasses(),
      'PHP Functions' => $results->getPHPFunctions(),
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
    return $this->getParameters()->getterm();
  }

  private function getSearchResults(): SearchResultSet {
    return ((new SearchResultSet())
      ->addAll(APIIndex::search($this->getSearchTerm()))
      ->addAll(GuidesIndex::search($this->getSearchTerm()))
      ->addAll(PHPAPIIndex::search($this->getSearchTerm()))
    );
  }
}
