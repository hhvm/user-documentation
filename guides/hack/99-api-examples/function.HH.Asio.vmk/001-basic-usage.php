<?hh

/**
 * Query an arbitrary number of URLs in parallel
 * returning them as a Vector of string responses.
 */
async function getUrls(
  ConstVector<string> $urls,
): Awaitable<Vector<string>> {

  // Await on curl requests in parallel and
  // prepend the request ID index
  return await \HH\Asio\vmk(
    $urls,
    async ($idx, $url) ==> {
      $content = await \HH\Asio\curl_exec($url);
      return $idx . " => " . $content;
    },
  );
}

$urls = ImmVector {
  "http://example.com",
  "http://example.net",
  "http://example.org",
};

$pages = \HH\Asio\join(getUrls($urls));
foreach ($pages as $page) {
  echo substr($page, 0, 20) . ' ... ' . substr($page, -8);
}

