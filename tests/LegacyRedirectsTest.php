<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace HH\Lib\{C, Str};
use type HHVM\UserDocumentation\{Guides, GuidesIndex, GuidesProduct};
use function Facebook\FBExpect\expect;
use type Facebook\HackTest\DataProvider;

final class LegacyRedirectsTest extends \Facebook\HackTest\HackTest {
  public function getGuideRedirects(): dict<string, (string, string)> {
    $ret = dict[];
    foreach (
      Guides::getGuidePageRedirects(GuidesProduct::HACK) as $guide => $pages
    ) {
      foreach ($pages as $page => $target) {
        $old = Str\format('/%s/%s/%s', GuidesProduct::HACK, $guide, $page);
        $ret[$old] = tuple(
          $old,
          self::getTargetURL(GuidesProduct::HACK, $target),
        );
      }
    }
    foreach (
      Guides::getGuideRedirects(GuidesProduct::HACK) as $guide => $target
    ) {
      $target = self::getTargetURL(GuidesProduct::HACK, $target);
      $old = Str\format('/%s/%s/', GuidesProduct::HACK, $guide);
      $ret[$old] = tuple($old, $target);
      $old = Str\format('/%s/%s/idonotexist', GuidesProduct::HACK, $guide);
      $ret[$old] = tuple($old, $target);
    }
    return $ret;
  }

  private static function getTargetURL(
    GuidesProduct $product,
    (string, ?string) $target,
  ): string {
    list($guide, $page) = $target;
    $page ??= C\firstx(GuidesIndex::getPages($product, $guide));
    return Str\format('/%s/%s/%s', $product, $guide, $page);
  }

  <<DataProvider('getGuideRedirects')>>
  public async function testGuideRedirects(
    string $in,
    string $target,
  ): Awaitable<void> {
    list($response, $body) = await PageLoader::getPageAsync($in);
    expect($response->getStatusCode())->toBeSame(301);
    $actual_target = $response->getHeaderLine('Location');
    expect($actual_target)->toBeSame($target);
    list($response, $_) = await PageLoader::getPageAsync($actual_target);
    expect($response->getStatusCode())->toBeSame(200);
  }
}
