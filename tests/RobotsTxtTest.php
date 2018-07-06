<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type \RobotsTxtController;

/**
 * @group remote
 * @small
 */
class RobotsTxtTest extends \PHPUnit_Framework_TestCase {
  public function testMainDomainAllowsCrawling(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://docs.hhvm.com/robots.txt'),
    );
    $this->assertSame(
      \file_get_contents(RobotsTxtController::DEFAULT_FILE),
      (string) $response->getBody(),
    );
  }

  public function testStagingDoesNotAllowCrawling(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://staging.docs.hhvm.com/robots.txt'),
    );
    $this->assertSame(
      \file_get_contents(RobotsTxtController::DO_NOT_CRAWL_FILE),
      (string) $response->getBody(),
    );
  }
}
