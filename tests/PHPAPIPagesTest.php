<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */

final class PHPAPIPagesTest extends \Facebook\HackTest\HackTest {
  public async function testHackReferenceLinksToPHPReference(
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync('/hack/reference/');
    expect($response->getStatusCode())->toBeSame(200);
    expect($body)->toContain('/php/reference/');
  }

  public async function testPHPReferencePageContainsSupportedAPIs(
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync('/php/reference/');
    expect($response->getStatusCode())->toBeSame(200);

    expect($body)->toContain('php.net/manual/en/class.iterator.php');

    expect($body)->toContain('php.net/manual/en/function.asort.php');
  }

  public async function testPHPReferencePageOmitsUnsupportedAPIs(
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync('/php/reference/');
    expect($response->getStatusCode())->toBeSame(200);

    expect($body)->toNotContain('php.net/manual/en/class.com.php');

    expect($body)->toNotContain(
      'php.net/manual/en/function.zend-logo-guid.php',
    );
  }
}
