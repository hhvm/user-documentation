// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\XhpAsync;

<<__EntryPoint>>
async function extending_examples_async_run(): Awaitable<void> {
  \init_docs_autoloader();

  $status = <ui_get_status />;
  $html = await $status->toStringAsync();
  // This can be long, so just show a bit for illustrative purposes
  $sub_status = \substr($html, 0, 100);
  \var_dump($sub_status);
}
