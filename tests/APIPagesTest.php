<?hh // partial

namespace HHVM\UserDocumentation\Tests;

use type HHVM\UserDocumentation\{
  APIDefinitionType,
  APINavData,
  APIProduct,
  LocalConfig,
  NavDataNode,
  URLBuilder,
};

use namespace HH\Lib\{C, Str, Vec};
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\{DataProvider, TestGroup};

class APIPagesTest extends \Facebook\HackTest\HackTest {
  public static function allAPIPages(): vec<(string, NavDataNode)> {
    $to_visit = \array_values(APINavData::get(APIProduct::HACK)->getNavData());
    $out = vec[];

    while (!C\is_empty($to_visit)) {
      $node = \array_pop(inout $to_visit);
      foreach ($node['children'] as $child) {
        $to_visit[] = $child;
      }
      $node['children'] = varray[]; // make failure output easier to read
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

  <<DataProvider('shortListOfAPIPages'), TestGroup('remote')>>
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
      expect($body)->toContainSubstring($node['name']);
    }
  }

  public async function testMethodDeprecated(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      '/hack/reference/class/HH.Vector/fromArray/',
    );

    expect($body)->toContainSubstring('Deprecated');
  }

  public async function testNullableTypeMerged(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      '/hack/reference/class/HH.Vector/firstValue/',
    );

    expect($body)->toContainSubstring('<code>?Tv</code>');
  }

  public function getDoNotDocument(): vec<(string, APIDefinitionType)> {
    $classes = vec[
      // vec/dict/keyset are not classes; with HH prefix, they shouldn't exist
      'vec',
      'HH\\vec',
      'dict',
      'HH\\dict',
      'keyset',
      'HH\\keyset',
      // PHP classes
      'DOMElement',
      'IntlDateFormatter',
      'SimpleXMLElement',
      'stdClass',
      // Explicitly excluded classes
      '__PHP_Incomplete_Class',
      'LazyIterable',
      'LazyMapKeyedIterator',
      'WaitHandle',
    ]
      |> Vec\map($$, $x ==> tuple($x, APIDefinitionType::CLASS_DEF));

    $functions = vec[
      // Very unsupported
      'type_structure',
      'HH\\type_structure',
      // PHP functions
      'abs',
      'array_slice',
      'datefmt_create',
      'dom_document_save_html',
      'drawline',
      'intlcal_get',
      'memcache_get',
      'mysql_query',
      'pg_exec',
      // Explicitly excluded functions
      '_',
      '__hhvm_intrinsics.id_string',

    ]
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

  public function getPagesWithExamples(): vec<vec<string>> {
    $root = LocalConfig::ROOT.'/api-examples';
    $urls = keyset[];
    foreach (\glob($root.'/class.*/*') as $dir) {
      $urls[] = Str\replace($dir, $root.'/class.', 'class/');
    }
    foreach (\glob($root.'/function.*') as $dir) {
      $urls[] = Str\replace($dir, $root.'/function.', 'function/');
    }
    return Vec\map(
      $urls,
      $url ==> vec[Str\format(
        '/%s/reference/%s/',
        Str\contains($url, '/HH.Lib.') ? 'hsl' : 'hack',
        Str\strip_suffix($url, '.md'),
      )],
    );
  }

  <<DataProvider('getPagesWithExamples')>>
  public async function testExamples(string $url): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync($url);
    expect($response->getStatusCode())
      ->toBeSame(200, 'Examples provided for non-existent page %s.', $url);
    expect(Str\contains($body, '<a href="#examples">'))
      ->toBeTrue('Missing examples at %s.', $url);
  }

  public async function testGuideLinks(): Awaitable<void> {
    // page with 1 guide
    $url = '/hack/reference/class/HH.AsyncGenerator/';
    list($_, $body) = await PageLoader::getPageAsync($url);
    expect(Str\contains($body, '<a href="#guide">'))
      ->toBeTrue('Missing guide link at %s.', $url);

    // page with multiple guides
    $url = '/hack/reference/class/AsyncMysqlQueryResult/';
    list($_, $body) = await PageLoader::getPageAsync($url);
    expect(Str\contains($body, '<a href="#guides">'))
      ->toBeTrue('Missing guide links at %s.', $url);
  }
}
