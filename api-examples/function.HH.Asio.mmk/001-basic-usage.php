<?hh // partial

namespace Hack\UserDocumentation\API\Examples\HH\Asio\mmk;

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Map of string responses.
 */
async function get_urls(
  \ConstMap<string, string> $urls,
): Awaitable<Map<string, string>> {

  // Await on curl requests in parallel and
  // prepend the request ID index
  return await \HH\Asio\mmk(
    $urls,
    async ($name, $url) ==> {
      $content = await \HH\Asio\curl_exec($url);
      return $name." => ".$content;
    },
  );
}

<<__EntryPoint>>
function basic_usage_main(): void {
  $urls = ImmMap {
    'com' => "http://example.com",
    'net' => "http://example.net",
    'org' => "http://example.org",
  };

  $pages = \HH\Asio\join(get_urls($urls));
  foreach ($pages as $page) {
    echo \substr($page, 0, 22).' ... '.\substr($page, -8);
  }
}
