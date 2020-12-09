<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\AttributeTransfer;

<<__EntryPoint>>
async function extending_examples_good_attribute_transfer_run(
): Awaitable<void> {
  \init_docs_autoloader();

  $my_box =
    <ui_my_good_box
      id="id2"
      class="class2"
      extra_attr={42}
    />;
  echo await $my_box->toStringAsync();
}
