<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\NonAsyncHello;

function get_hello(): string {
  return "Hello";
}

<<__EntryPoint>>
function run_na_hello(): void {
  \init_docs_autoloader();

  \var_dump(get_hello());
}
