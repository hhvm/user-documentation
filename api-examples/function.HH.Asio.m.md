```basic-usage.php
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

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  $urls = ImmMap {
    'com' => "http://example.com",
    'net' => "http://example.net",
    'org' => "http://example.org",
  };

  $pages = await get_urls($urls);
  foreach ($pages as $name => $page) {
    echo $name.': ';
    echo \substr($page, 0, 15).' ... '.\substr($page, -8);
  }
}
```.skipif
<?php

// Skip if we don't have an internet connection
if (!get_headers("www.example.com")) {
  print "skip";
}
```
