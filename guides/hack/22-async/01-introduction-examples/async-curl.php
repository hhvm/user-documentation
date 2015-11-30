<?hh

namespace Hack\UserDocumentation\Async\Intro\Examples\Curl;

async function curl_A(): Awaitable<string> {
  $x = await \HH\Asio\curl_exec("http://example.com/");
  return $x;
}

async function curl_B(): Awaitable<string> {
  $y = await \HH\Asio\curl_exec("http://example.net/");
  return $y;
}

async function async_curl(): Awaitable<void> {
  $start = microtime(true);
  list($a, $b) = await \HH\Asio\v(array(curl_A(), curl_B()));
  $end = microtime(true);
  echo "Total time taken: " . strval($end - $start) . " seconds" . PHP_EOL;
}

\HH\Asio\join(async_curl());

