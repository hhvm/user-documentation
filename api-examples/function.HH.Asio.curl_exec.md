The following shows a scenario where you are going to wait for and return the result of cURL activity on URLs, using the convenient wrapper that is `curl_exec`.

```basic-usage.php
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
```
