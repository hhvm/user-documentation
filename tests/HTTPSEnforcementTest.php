<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use type Facebook\HackTest\DataProvider;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */
final class HTTPSEnforcementTest extends \Facebook\HackTest\HackTest {
  public async function testNoEnforcementByDefault(): Awaitable<void> {
    list($response, $_) =
      await PageLoader::getPageAsync('http://example.com/hack/reference/');
    expect($response->getStatusCode())->toBeSame(200);
  }

  public function httpsDomains(): array<array<string>> {
    return [['docs.hhvm.com'], ['staging.docs.hhvm.com']];
  }

  <<DataProvider('httpsDomains')>>
  public async function testEnforcedOnDomain(string $domain): Awaitable<void> {
    list($response, $_) =
      await PageLoader::getPageAsync('http://'.$domain.'/hack/reference/');
    expect($response->getStatusCode())->toBeSame(301);

    $location = $response->getHeaderLine('Location');
    expect($location)->toBeSame('https://'.$domain.'/hack/reference/');

    list($response, $_) = await PageLoader::getPageAsync($location);
    expect($response->getStatusCode())->toBeSame(200);

    $hsts = $response->getHeaderLine('Strict-Transport-Security');
    expect($hsts)->toContain('max-age=');
    expect($hsts)->toNotBeSame('max-age=0');
  }

  public async function testNotEnforcedOnRobotsTxt(): Awaitable<void> {
    list($response, $_) =
      await PageLoader::getPageAsync('http://docs.hhvm.com/robots.txt');
    expect($response->getStatusCode())->toBeSame(200);
  }

  public async function test404Status(): Awaitable<void> {
    list($response, $_) = await PageLoader::getPageAsync(
      'http://docs.hhvm.com/__idonotexist_fortesting',
    );
    expect($response->getStatusCode())->toBeSame(404);
  }
}
