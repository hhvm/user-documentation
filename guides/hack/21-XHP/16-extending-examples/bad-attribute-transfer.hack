// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\BadAttributeTransfer;

<<__EntryPoint>>
async function extending_examples_bad_attribute_transfer_run(
): Awaitable<void> {
  \init_docs_autoloader();

  $my_box = <ui_my_box title="My box" />;
  // This will only bring <div class="my-box"></div> ... title= will be
  // ignored.
  echo await $my_box->toStringAsync();
}
