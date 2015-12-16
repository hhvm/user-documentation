<?hh // strict

namespace HHVM\UserDocumentation\Tests;

/**
 * @group remote
 * @small
 */
final class HTTPSEnforcementTest extends \PHPUnit_Framework_TestCase {
  public function testNoEnforcementByDefault(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('http://example.com/hack/reference/')
    );
    $this->assertSame(
      200,
      $response->getStatusCode(),
    );
  }

  public function testEnforcedOnProd(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('http://docs.hhvm.com/hack/reference/')
    );
    $this->assertSame(
      301,
      $response->getStatusCode(),
    );
    $this->assertSame(
      'https://docs.hhvm.com/hack/reference/',
      $response->getHeaderLine('Location'),
    );
  }

  public function testEnforcedOnStaging(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('http://staging.docs.hhvm.com/hack/reference/')
    );
    $this->assertSame(
      301,
      $response->getStatusCode(),
    );
    $this->assertSame(
      'https://staging.docs.hhvm.com/hack/reference/',
      $response->getHeaderLine('Location'),
    );
  }

  public function testNotEnforcedOnRobotsTxt(): void {
    $response = \HH\Asio\join(
      PageLoader::getPage('http://docs.hhvm.com/robots.txt')
    );
    $this->assertSame(200, $response->getStatusCode());
  }
}
