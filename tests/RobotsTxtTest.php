<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type RobotsTxtController;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */
class RobotsTxtTest extends \Facebook\HackTest\HackTest {
  public function testMainDomainAllowsCrawling(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://docs.hhvm.com/robots.txt'),
    );
    expect(      (string) $response->getBody(),
)->toBeSame(
      \file_get_contents(RobotsTxtController::DEFAULT_FILE)    );
  }

  public function testStagingDoesNotAllowCrawling(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://staging.docs.hhvm.com/robots.txt'),
    );
    expect(      (string) $response->getBody(),
)->toBeSame(
      \file_get_contents(RobotsTxtController::DO_NOT_CRAWL_FILE)    );
  }
}
