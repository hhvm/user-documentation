<?hh // strict

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */
class SpecialPagesTest extends \PHPUnit_Framework_TestCase {
  public function notFoundPathProvider(): array<array<string>> {
    return [
      ['/_I_DO_NOT_EXIST_FOR_TESTING_'],
      ['/manual/en/_I_DO_NOT_EXIST_FOR_TESTING_.php'],
      ['/hack/reference/_BAD_DEFINITION_TYPE_FOR_TESTING_/'],
      ['/hack/reference/class/_BAD_CLASS_NAME_FOR_TESTING_/'],
    ];
  }

  /**
   * @dataProvider notFoundPathProvider
   */
  public function testNotFoundPages(string $path): void {
    $response = \HH\Asio\join(PageLoader::getPage($path));
    $this->assertSame(404, $response->getStatusCode());
    $this->assertContains("does not exist", (string) $response->getBody());
  }

  public function redirectProvider(): array<string, (string, string)> {
    return [
      'Hack class documentation' => tuple(
        '/manual/en/class.hack.maptktv.php',
        '/hack/reference/class/Map/',
      ),
      'Hack interface reference with added namespace' => tuple(
        '/manual/en/class.hack.iterabletv.php',
        '/hack/reference/interface/HH.Iterable/',
      ),
      'Hack function reference' => tuple(
        '/manual/en/hackfuncref.php',
        '/hack/reference/',
      ),
      'Hack function reference with preserved namespace' => tuple(
        '/manual/en/hack.asio.function.v.php',
        '/hack/reference/function/HH.Asio.v/',
      ),
      'Guide dir => first page of guide' => tuple(
        '/hack/getting-started/',
        '/hack/getting-started/getting-started',
      ),
      'PHP function documentation' => tuple(
        '/manual/en/function.parse-url.php',
        'http://php.net/manual/en/function.parse-url.php',
      ),
      'PHP refentry article' => tuple(
        '/manual/en/mail.configuration.php',
        'http://php.net/manual/en/mail.configuration.php',
      ),
      'PHP book' => tuple(
        '/manual/en/book.apc.php',
        'http://php.net/manual/en/book.apc.php',
      ),
      'PHP "sect1"' => tuple(
        '/manual/en/language.oop5.constants.php',
        'http://php.net/manual/en/language.oop5.constants.php',
      ),
      'PHP "set"' => tuple(
        '/manual/en/refs.creditcard.php',
        'http://php.net/manual/en/refs.creditcard.php',
      ),
      'PHP book chapter' => tuple(
        '/manual/en/oci8.connection.php',
        'http://php.net/manual/en/oci8.connection.php',
      ),
      'PHP topic reference' => tuple(
        '/manual/en/ref.array.php',
        'http://php.net/manual/en/ref.array.php',
      ),
      'PHP book section' => tuple(
        '/manual/en/classkit.configuration.php',
        'http://php.net/manual/en/classkit.configuration.php',
      ),
      'PHP appendix' => tuple(
        '/manual/en/stream.constants.php',
        'http://php.net/manual/en/stream.constants.php'
      ),
      'Beta redirect root' => tuple(
        'http://beta.docs.hhvm.com/',
        'http://docs.hhvm.com/',
      ),
      'Beta redirect page' => tuple(
        'http://beta.docs.hhvm.com/hack/reference/',
        'http://docs.hhvm.com/hack/reference/',
      ),
      'Old Hack collection class overview' => tuple(
        '/manual/en/hack.collections.vector.php',
        '/hack/reference/class/Vector/',
      ),
      'Missing trailing /' => tuple(
        '/hack/reference/class/Map',
        '/hack/reference/class/Map/',
      ),
      'PHP bad punctuation' => tuple(
        '/manual/en/debugger.about.php',
        'http://php.net/manual/en/debugger-about.php',
      ),
      'PHP good punctuation' => tuple(
        '/manual/en/debugger-about.php',
        'http://php.net/manual/en/debugger-about.php',
      ),
      'Case insensitve redirect' => tuple(
        '/manual/en/HaCk.LAMbda.php',
        '/hack/lambdas/introduction',
      ),
    ];
  }

  /**
   * @dataProvider redirectProvider
   */
  public function testRedirects(string $from, string $to): void {
    $response = \HH\Asio\join(PageLoader::getPage($from));
    $this->assertSame(301, $response->getStatusCode());

    $target = $response->getHeaderLine('Location');
    $this->assertNotEmpty($target, 'no location header');

    $this->assertSame($to, $target);
  }

  public function testStaticResource404(): void {
    $response = \HH\Asio\join(PageLoader::getPage('/s/deadbeef/notfound'));
    $this->assertSame(404, $response->getStatusCode());
  }

  public function notFoundSuggestions(): array<(string, string)> {
    return [
      tuple('/map', '/hack/reference/class/Map/'),
      tuple('/maptktv.filter', '/hack/reference/class/Map/filter/'),
    ];
  }

  /**
   * @dataProvider notFoundSuggestions
   */
  public function testNotFoundSuggestion(
    string $notfound,
    string $suggestion,
  ): void {
    $response = \HH\Asio\join(PageLoader::getPage($notfound));
    $this->assertSame(404, $response->getStatusCode());

    $body = (string) $response->getBody();
    $this->assertContains($suggestion, $body);
  }
}
