<?hh // strict

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */

final class PHPAPIPagesTest extends \PHPUnit_Framework_TestCase {
  public function testHackReferenceLinksToPHPReference(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/hack/reference/'));
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();
    $this->assertContains(
      '/php/reference/',
      $body,
    );
  }

  public function testPHPReferencePageContainsSupportedAPIs(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/php/reference/'));
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();

    $this->assertContains(
      'php.net/manual/en/class.iterator.php',
      $body,
    );

    $this->assertContains(
      'php.net/manual/en/function.asort.php',
      $body,
    );
  }

  public function testPHPReferencePageOmitsUnsupportedAPIs(): void {
    $response = \HH\Asio\join(PageLoader::getPageAsync('/php/reference/'));
    $this->assertSame(200, $response->getStatusCode());
    $body = (string) $response->getBody();

    $this->assertNotContains(
      'php.net/manual/en/class.com.php',
      $body,
    );

    $this->assertNotContains(
      'php.net/manual/en/function.zend-logo-guid.php',
      $body,
    );
  }
}
