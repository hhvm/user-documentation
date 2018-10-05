<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */

final class PHPAPIPagesTest extends \Facebook\HackTest\HackTest {
  public function testHackReferenceLinksToPHPReference(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/hack/reference/'));
    expect($response->getStatusCode())->toBeSame(200);
    $body = (string) $response->getBody();
    expect(      $body,
)->toContain(
      '/php/reference/'    );
  }

  public function testPHPReferencePageContainsSupportedAPIs(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/php/reference/'));
    expect($response->getStatusCode())->toBeSame(200);
    $body = (string) $response->getBody();

    expect(      $body,
)->toContain(
      'php.net/manual/en/class.iterator.php'    );

    expect(      $body,
)->toContain(
      'php.net/manual/en/function.asort.php'    );
  }

  public function testPHPReferencePageOmitsUnsupportedAPIs(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/php/reference/'));
    expect($response->getStatusCode())->toBeSame(200);
    $body = (string) $response->getBody();

    expect(      $body,
)->toNotContain(
      'php.net/manual/en/class.com.php'    );

    expect(      $body,
)->toNotContain(
      'php.net/manual/en/function.zend-logo-guid.php'    );
  }
}
