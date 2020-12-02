```basic-usage.php
/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Vector of string responses.
 */
async function get_urls(\ConstVector<string> $urls): Awaitable<Vector<string>> {
  // Wrap each URL string into a curl_exec awaitable
  $handles = $urls->map($url ==> \HH\Asio\curl_exec($url));

  // Wait on each handle in parallel and return the results
  return await \HH\Asio\v($handles);
}

<<__EntryPoint>>
async function basic_usage_main(): Awaitable<void> {
  $urls = ImmVector {
    "http://example.com",
    "http://example.net",
    "http://example.org",
  };

  $pages = await get_urls($urls);
  foreach ($pages as $page) {
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
