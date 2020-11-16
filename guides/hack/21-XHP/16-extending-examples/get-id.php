<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\GetId;

<<__EntryPoint>>
async function extending_examples_get_id_run(): Awaitable<void> {
  \init_docs_autoloader();

  // This will print something like:
  // <span id="8b95a23bc0">This has a random id</span>
  $xhp = <my_id />;
  echo await $xhp->toStringAsync();
}
