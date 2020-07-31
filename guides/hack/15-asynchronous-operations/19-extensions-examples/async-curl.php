<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncCurl;

function get_urls(): vec<string> {
  return vec[
    "http://example.com",
    "http://example.net",
    "http://example.org",
  ];
}

async function get_combined_contents(
  vec<string> $urls,
): Awaitable<vec<string>> {
  // Use lambda shorthand syntax here instead of full closure syntax
  $handles = \HH\Lib\Vec\map_with_key(
    $urls,
    ($idx, $url) ==> \HH\Asio\curl_exec($url),
  );
  $contents = await \HH\Lib\Vec\from_async($handles);
  echo \HH\Lib\C\count($contents)."\n";
  return $contents;
}

<<__EntryPoint>>
function main(): void {
  \__init_autoload();
  \HH\Asio\join(get_combined_contents(get_urls()));
}
