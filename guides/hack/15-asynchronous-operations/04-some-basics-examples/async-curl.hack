use namespace HH\Lib\Vec;
use function HH\Lib\Vec\{from_async};
use function HH\Asio\{curl_exec};
use function microtime;

async function curl_A(): Awaitable<string> {
  $x = await curl_exec("http://example.com/");
  return $x;
}

async function curl_B(): Awaitable<string> {
  $y = await curl_exec("http://example.net/");
  return $y;
}

async function async_curl(): Awaitable<void> {
  $start = microtime(true);
  list($a, $b) = await from_async(vec[curl_A(), curl_B()]);
  $end = microtime(true);
  echo "Total time taken: ".\strval($end - $start)." seconds\n";
}
