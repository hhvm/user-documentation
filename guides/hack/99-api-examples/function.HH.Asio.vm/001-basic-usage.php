<?hh

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Vector of string responses.
 *
 * Refer to \HH\Asio\v() for a more verbose version of this.
 */
async function getUrls(
  ConstVector<string> $urls,
): Awaitable<Vector<string>> {

  // Invoke \HH\Asio\curl_exec for each URL,
  // then await on each in parallel
  return await \HH\Asio\vm(
    $urls,
    fun("\HH\Asio\curl_exec"),
  );
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

