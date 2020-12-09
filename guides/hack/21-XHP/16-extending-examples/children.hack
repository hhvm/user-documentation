// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\Children;

use namespace Facebook\XHP;
use type Facebook\XHP\HTML\{body, head, li, ul};

<<__EntryPoint>>
async function extending_examples_children_run(): Awaitable<void> {
  \init_docs_autoloader();

  $my_br = <my_br />;
  // Even though my-br does not take any children, you can still call the
  // appendChild method with no consequences. The consequence will come when
  // you try to render the object by something like an echo.
  $my_br->appendChild(<ul />);
  try {
    echo await $my_br->toStringAsync()."\n";
  } catch (XHP\InvalidChildrenException $ex) {
    \var_dump($ex->getMessage());
  }
  $my_ul = <my_ul />;
  $my_ul->appendChild(<li />);
  $my_ul->appendChild(<li />);
  echo await $my_ul->toStringAsync()."\n";
  $my_html = <my_html />;
  $my_html->appendChild(<head />);
  $my_html->appendChild(<body />);
  echo await $my_html->toStringAsync()."\n";
}
