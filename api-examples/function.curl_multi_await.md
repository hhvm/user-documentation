The following shows a scenario where you are going to wait for and return the result of activity on multiple curl handles. A bit of a simpler approach would be to use [`HH\Asio\curl_exec`](//hack/reference/function/HH.Asio.curl_exec/), which is a wrapper around `curl_multi_await`.

```basic-usage.php
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
    $ret = \curl_multi_exec($mh, inout $active);
  } while ($ret == \CURLM_CALL_MULTI_PERFORM);

  while ($active && $ret == \CURLM_OK) {
    $select = await \curl_multi_await($mh);
    if ($select === -1) {
      // https://bugs.php.net/bug.php?id=61141
      await \HH\Asio\usleep(100);
    }
    do {
      $ret = \curl_multi_exec($mh, inout $active);
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

<<__EntryPoint>>
async function run(): Awaitable<void> {
  $urls = Set {'http://www.google.com', 'https://www.cnn.com'};
  $content = await get_curl_content($urls);
  \var_dump($content);
}
```
