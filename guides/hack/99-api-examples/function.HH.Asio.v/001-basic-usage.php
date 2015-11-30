<?hh

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Vector of string responses.
 */
async function getUrls(
  ConstVector<string> $urls,
): Awaitable<Vector<string>> {
  // Wrap each URL string into a curl_exec awaitable
  $handles = $urls->map($url ==> \HH\Asio\curl_exec($url));

  // Wait on each handle in parallel and return the results
  return await \HH\Asio\v($handles);
}

$urls = ImmVector {
  "http://example.com",
  "http://example.net",
  "http://example.org",
};

$pages = \HH\Asio\join(getUrls($urls));
foreach ($pages as $page) {
  echo substr($page, 0, 15) . ' ... ' . substr($page, -8);
}

