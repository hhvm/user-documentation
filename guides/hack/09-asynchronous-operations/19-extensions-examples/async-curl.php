<?hh // strict

namespace Hack\UserDocumentation\AsyncOps\Extensions\Examples\AsyncCurl;

function get_urls(): vec<string> {
  return vec[
    "http://example.com",
    "http://example.net",
    "http://example.org",
  ];
}

async function get_combined_contents(vec<string> $urls): Awaitable<vec<string>> {
  // Use lambda shorthand syntax here instead of full closure syntax


//  $handles = $urls->mapWithKey(($idx, $url) ==> \HH\Asio\curl_exec($url));
  $handles = \HH\Lib\Vec\map_with_key($urls, ($idx, $url) ==> \HH\Asio\curl_exec($url));


//  $contents = await \HH\Asio\v($handles);
  $contents = await \HH\Lib\Vec\from_async($handles);


//  echo $contents->count();
  echo \HH\Lib\C\count($contents) . "\n";
  

  return $contents;
}

<<__Entrypoint>>
function main(): void {
  \HH\Asio\join(get_combined_contents(get_urls()));
}

