<?hh // partial

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\{
  APIDefinitionType,
  APINavData,
  APIProduct,
  NavDataNode,
  URLBuilder,
};

use namespace HH\Lib\Vec;
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;

class APIPagesTest extends \Facebook\HackTest\HackTest {
  public static function allAPIPages(): array<(string, NavDataNode)> {
    $to_visit = \array_values(APINavData::get(APIProduct::HACK)->getNavData());
    $out = [];

    while ($node = \array_pop(&$to_visit)) {
      foreach ($node['children'] as $child) {
        $to_visit[] = $child;
      }
      $node['children'] = []; // make failure output easier to read
      $out[] = tuple($node['urlPath'], $node);
    }
    return $out;
  }

  public function shortListOfAPIPages(): vec<(string, NavDataNode)> {
    $wanted = Set {
      '/hack/reference/class/', // index
      '/hack/reference/class/AsyncMysqlClient/', // class
      '/hack/reference/class/AsyncMysqlConnection/queryf/', // method
      '/hack/reference/function/hphp_array_idx/', // function
      '/hack/reference/class/HH.Asio.WrappedResult/', // namespaced
    };
    $all = self::allAPIPages();
    $out = vec[];
    foreach ($all as $tuple) {
      list($_, $node) = $tuple;
      if ($wanted->contains($node['urlPath'])) {
        $out[] = tuple($node['urlPath'], $node);
      }
    }
    expect(\count($out))->toBeSame(\count($wanted));

    // Not included in the API Nav bar, but test it too :)
    $out[] = tuple(
      '/hack/reference/',
      shape(
        'urlPath' => '/hack/reference/',
        'name' => 'Hack APIs',
        'children' => dict[],
      ),
    );
    return $out;
  }

  /**
   * @large
   */
  <<DataProvider('allAPIPages')>>
  public async function testAPIPage(
    string $name,
    NavDataNode $node,
  ): Awaitable<void> {
    await $this->testAPIPageQuick($name, $node);
  }

  /**
   * @group remote
   * @small
   */
  <<DataProvider('shortListOfAPIPages')>>
  public async function testAPIPageQuick(
    string $_,
    NavDataNode $node,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync($node['urlPath']);
    expect($response->getStatusCode())->toBeSame(200);

    // Top-level pages don't contain their own name in the output - eg 'Classes'
    // is 'Class Reference'
    $blacklist = (new Set(APIDefinitionType::getValues()))->map(
      $x ==> APINavData::get(APIProduct::HACK)->getRootNameForType($x),
    );
    if (!$blacklist->contains($node['name'])) {
      expect($body)->toContain($node['name']);
    }
  }

  public async function testMethodDeprecated(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      '/hack/reference/class/HH.Vector/fromArray/',
    );

    expect($body)->toContain('Deprecated');
  }

  public async function testNullableTypeMerged(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      '/hack/reference/class/HH.Vector/firstValue/',
    );

    expect($body)->toContain('<code>?Tv</code>');
  }

  public function getDoNotDocument(): vec<(string, APIDefinitionType)> {
    // vec/dict/keyset are not classes; with HH prefix, they shouldn't exist
    $classes = vec['vec', 'HH\\vec', 'dict', 'HH\\dict', 'keyset', 'HH\\keyset']
      |> Vec\map($$, $x ==> tuple($x, APIDefinitionType::CLASS_DEF));

    // Very unsupported
    $functions = vec['type_structure', 'HH\\type_structure']
      |> Vec\map($$, $x ==> tuple($x, APIDefinitionType::FUNCTION_DEF));

    return Vec\concat($classes, $functions);
  }

  <<DataProvider('getDoNotDocument')>>
  public async function testDoesNotDocument(
    string $name,
    APIDefinitionType $type,
  ): Awaitable<void> {
    switch ($type) {
      case APIDefinitionType::CLASS_DEF:
      case APIDefinitionType::TRAIT_DEF:
      case APIDefinitionType::INTERFACE_DEF:
        $url = URLBuilder::getPathForClass(
          APIProduct::HACK,
          shape('name' => $name, 'type' => $type),
        );
        break;
      case APIDefinitionType::FUNCTION_DEF:
        $url = URLBuilder::getPathForFunction(
          APIProduct::HACK,
          shape('name' => $name),
        );
        break;
    }
    list($response, $_) = await PageLoader::getPageAsync($url);
    expect($response->getStatusCode())->toBeSame(
      404,
      \sprintf('"%s" should not be documented', $name),
    );
  }
}
