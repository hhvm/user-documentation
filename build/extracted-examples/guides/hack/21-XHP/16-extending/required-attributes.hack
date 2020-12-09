// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\RequiredAttributes;

use namespace Facebook\XHP;

<<__EntryPoint>>
async function extending_examples_attributes_run(): Awaitable<void> {
  \init_docs_autoloader();

  /* HH_FIXME[4314] Missing required attribute is also a typechecker error. */
  $uinfo = <user_info />;
  // Can't render :user-info for an echo without setting the required userid
  // attribute
  try {
    echo await $uinfo->toStringAsync();
  } catch (XHP\AttributeRequiredException $ex) {
    \var_dump($ex->getMessage());
  }

  /* HH_FIXME[4314] This is a typechecker error but not a runtime error. */
  $uinfo = <user_info />;
  $uinfo->setAttribute('userid', 1000);
  $uinfo->setAttribute('name', 'Joel');
  echo await $uinfo->toStringAsync();
}
