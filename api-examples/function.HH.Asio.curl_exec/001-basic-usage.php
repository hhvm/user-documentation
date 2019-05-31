<?hh // partial

namespace Hack\UserDocumentation\API\Examples\ce;

require __DIR__ . "/../../vendor/autoload.php";

async function get_curl_content(Set<string> $urls): Awaitable<Vector<string>> {
  $content = Vector {};
  foreach ($urls as $url) {
    $str = await \HH\Asio\curl_exec($url);
    $content[] = \substr($str, 0, 10);
  }
  return $content;
}

function run(): void {
  $urls = Set {'http://www.google.com', 'http://www.cnn.com'};
  $content = \HH\Asio\join(get_curl_content($urls));
  \var_dump($content);
}

run();
