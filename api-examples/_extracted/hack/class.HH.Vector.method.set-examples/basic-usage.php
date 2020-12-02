<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodSet\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Set the first element to 'RED'
  $v->set(0, 'RED');

  \var_dump($v);

  // Set the second and third elements using chaining
  $v->set(1, 'GREEN')
    ->set(2, 'BLUE');

  \var_dump($v);
}
