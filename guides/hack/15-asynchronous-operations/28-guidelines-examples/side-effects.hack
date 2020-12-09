// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\SideEffects;

async function get_curl_data(string $url): Awaitable<string> {
  return await \HH\Asio\curl_exec($url);
}

function possible_side_effects(): int {
  \sleep(1);
  echo "Output buffer stuff";
  return 4;
}

async function proximity(): Awaitable<void> {
  $handle = get_curl_data("http://example.com");
  possible_side_effects();
  await $handle; // instead you should await get_curl_data("....") here
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \HH\Asio\join(proximity());
}
