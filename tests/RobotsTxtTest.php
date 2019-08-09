<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use type RobotsTxtController;
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\TestGroup;

class RobotsTxtTest extends \Facebook\HackTest\HackTest {
  <<TestGroup('remote')>>
  public async function testMainDomainAllowsCrawling(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      'http://docs.hhvm.com/robots.txt',
    );
    expect($body)->toBeSame(
      \file_get_contents(RobotsTxtController::DEFAULT_FILE),
    );
  }

  <<TestGroup('remote')>>
  public async function testStagingDoesNotAllowCrawling(): Awaitable<void> {
    list($_, $body) = await PageLoader::getPageAsync(
      'http://staging.docs.hhvm.com/robots.txt',
    );
    expect($body)->toBeSame(
      \file_get_contents(RobotsTxtController::DO_NOT_CRAWL_FILE),
    );
  }
}
