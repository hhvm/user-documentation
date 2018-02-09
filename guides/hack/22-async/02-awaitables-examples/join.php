<?hh

namespace Hack\UserDocumentation\Async\Awaitables\Examples\Join;

async function get_raw(string $url): Awaitable<string> {
  return await \HH\Asio\curl_exec($url);
}

function join_main(): void {
  $result = \HH\Asio\join(get_raw("http://www.example.com"));
  \var_dump(\substr($result, 0, 10));
}

join_main();
