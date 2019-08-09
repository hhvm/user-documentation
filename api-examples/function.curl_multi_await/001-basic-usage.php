<?hh // partial

namespace Hack\UserDocumentation\API\Examples\cma;

require __DIR__."/../../vendor/autoload.php";

async function get_curl_content(Set<string> $urls): Awaitable<Vector<string>> {

  $chs = Vector {};
  foreach ($urls as $url) {
    $ch = \curl_init($url);
    \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, true);
    $chs[] = $ch;
  }

  $mh = \curl_multi_init();
  foreach ($chs as $ch) {
    \curl_multi_add_handle($mh, $ch);
  }

  $active = -1;
  do {
    $ret = \curl_multi_exec($mh, &$active);
  } while ($ret == \CURLM_CALL_MULTI_PERFORM);

  while ($active && $ret == \CURLM_OK) {
    $select = await \curl_multi_await($mh);
    if ($select === -1) {
      // https://bugs.php.net/bug.php?id=61141
      await \HH\Asio\usleep(100);
    }
    do {
      $ret = \curl_multi_exec($mh, &$active);
    } while ($ret == \CURLM_CALL_MULTI_PERFORM);
  }

  $content = Vector {};

  foreach ($chs as $ch) {
    $str = (string)\curl_multi_getcontent($ch);
    $content[] = \substr($str, 0, 10);
    \curl_multi_remove_handle($mh, $ch);
  }

  \curl_multi_close($mh);

  return $content;
}

function run(): void {
  $urls = Set {'http://www.google.com', 'http://www.cnn.com'};
  $content = \HH\Asio\join(get_curl_content($urls));
  \var_dump($content);
}

run();
