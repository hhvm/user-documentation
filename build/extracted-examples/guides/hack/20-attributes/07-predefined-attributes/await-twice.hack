// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Attributes\PredefinedAttributes\AwaitTwice;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $x = async { print("Hello, world\n"); return 42; };
  \var_dump(await $x);
  \var_dump(await $x);
}
