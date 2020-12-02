<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodSetAll\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Set the elements at 0 and 1
  $v->setAll(Vector {'foo', 'bar'});
  \var_dump($v);

  // Set the elements at 2 and 3
  $v->setAll(Map {
    2 => 'baz',
    3 => 'qux',
  });
  \var_dump($v);
}
