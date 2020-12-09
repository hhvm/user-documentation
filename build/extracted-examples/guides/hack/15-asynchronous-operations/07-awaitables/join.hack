// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Awaitables\Join;

async function get_raw(string $url): Awaitable<string> {
  return await \HH\Asio\curl_exec($url);
}

<<__EntryPoint>>
function join_main(): void {
  \init_docs_autoloader();

  $result = \HH\Asio\join(get_raw("http://www.example.com"));
  \var_dump(\substr($result, 0, 10));
}
