<?hh

namespace Hack\UserDocumentation\Async\Extensions\Examples\Curl;

function get_urls(): Vector<string> {
  $urls = Vector {"http://google.com", "http://facebook.com",
                  "http://www.immigration.govt.nz/"};
  return $urls;
}

async function get_combined_contents(Vector $urls): Awaitable<Vector<string>> {
  // Use lambda shorthand syntax here instead of full closure syntax
  $handles = $urls->mapWithKey(($idx, $url) ==> \HH\Asio\curl_exec($url));
  $contents = await \HH\Asio\v($handles);
  echo $contents->count();
  return $contents;
}

\HH\Asio\join(get_combined_contents(get_urls()));
