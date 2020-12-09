// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Extending\AddClass;

use type Facebook\XHP\HTML\h1;

function get_header(string $section_name): h1 {
  return (<h1 class="initial-cls">{$section_name}</h1>)
    ->addClass('added-cls')
    ->conditionClass($section_name === 'Home', 'home-cls');
}

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();

  $xhp = get_header('Home');
  echo await $xhp->toStringAsync()."\n";

  $xhp = get_header('Contact');
  echo await $xhp->toStringAsync()."\n";
}
