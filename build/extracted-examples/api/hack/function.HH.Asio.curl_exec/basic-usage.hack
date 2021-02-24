// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\FunctionHHAsioCurlExec\BasicUsage;

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
  \init_docs_autoloader();

  $urls = Set {
    'https://hhvm.com/blog/2020/05/04/hhvm-4.56.html',
    'https://hhvm.com/blog/2020/10/21/hhvm-4.80.html',
  };
  $content = await get_curl_content($urls);
  \var_dump($content);
}
