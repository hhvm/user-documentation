<?hh // partial

namespace Hack\UserDocumentation\API\Examples\HH\Asio\m;

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Map of string responses.
 */
async function get_urls(
  \ConstMap<string, string> $urls,
): Awaitable<Map<string, string>> {
  // Wrap each URL string into a curl_exec awaitable
  $handles = $urls->map($url ==> \HH\Asio\curl_exec($url));

  // Wait on each handle in parallel and return the results
  return await \HH\Asio\m($handles);
}

$urls = ImmMap {
  'com' => "http://example.com",
  'net' => "http://example.net",
  'org' => "http://example.org",
};

$pages = \HH\Asio\join(get_urls($urls));
foreach ($pages as $name => $page) {
  echo $name . ': ';
  echo substr($page, 0, 15) . ' ... ' . substr($page, -8);
}

