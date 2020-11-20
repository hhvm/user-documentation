<?hh

namespace Hack\UserDocumentation\API\Examples\ce;

async function get_curl_content(Set<string> $urls): Awaitable<Vector<string>> {
  $content = Vector {};
  foreach ($urls as $url) {
    $str = await \HH\Asio\curl_exec($url);
    $content[] = \substr($str, 0, 10);
  }
  return $content;
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $urls = Set {'http://www.google.com', 'https://www.cnn.com'};
  $content = await get_curl_content($urls);
  \var_dump($content);
}
