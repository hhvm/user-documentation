<?hh // strict

namespace HHVM\UserDocumentation\Tests;
use function Facebook\FBExpect\expect;

/**
 * @group remote
 * @small
 */
final class HTTPSEnforcementTest extends \Facebook\HackTest\HackTest {
  public function testNoEnforcementByDefault(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://example.com/hack/reference/'),
    );
    expect(      $response->getStatusCode(),
)->toBeSame(
      200    );
  }

  public function httpsDomains(): array<array<string>> {
    return [
      ['docs.hhvm.com'],
      ['staging.docs.hhvm.com'],
    ];
  }

  <<DataProvider('httpsDomains')>>
  public function testEnforcedOnDomain(string $domain): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://'.$domain.'/hack/reference/'),
    );
    expect($response->getStatusCode())->toBeSame(301);

    $location = $response->getHeaderLine('Location');
    expect(      $location,
)->toBeSame(
      'https://'.$domain.'/hack/reference/'    );

    $response = \HH\Asio\join(PageLoader::getPageAsync($location));
    expect($response->getStatusCode())->toBeSame(200);

    $hsts = $response->getHeaderLine('Strict-Transport-Security');
    expect(      $hsts,
)->toContain(
      'max-age='    );
    expect(      $hsts,
)->toNotBeSame(
      'max-age=0'    );
  }

  public function testNotEnforcedOnRobotsTxt(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://docs.hhvm.com/robots.txt'),
    );
    expect($response->getStatusCode())->toBeSame(200);
  }

  public function test404DoesNot500(): void {
    $response = \HH\Asio\join(
      PageLoader::getPageAsync('http://docs.hhvm.com/__idonotexist_fortesting'),
    );
    expect($response->getStatusCode())->toNotBeSame(500);
  }
}
