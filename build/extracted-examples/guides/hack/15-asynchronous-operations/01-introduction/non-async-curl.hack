// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Introduction\NonAsyncCurl;

function curl_A(): mixed {
  $ch = \curl_init();
  \curl_setopt($ch, \CURLOPT_URL, "http://example.com/");
  \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
  return \curl_exec($ch);
}

function curl_B(): mixed {
  $ch = \curl_init();
  \curl_setopt($ch, \CURLOPT_URL, "http://example.net/");
  \curl_setopt($ch, \CURLOPT_RETURNTRANSFER, 1);
  return \curl_exec($ch);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $start = \microtime(true);
  $a = curl_A();
  $b = curl_B();
  $end = \microtime(true);
  echo "Total time taken: ".\strval($end - $start)." seconds\n";
}
