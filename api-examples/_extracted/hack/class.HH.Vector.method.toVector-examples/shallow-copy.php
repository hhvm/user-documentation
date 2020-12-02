<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodToVector\ShallowCopy;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $inner = Vector {1, 2, 3};
  $v = Vector {Vector {'a'}, $inner, Vector {'c'}};

  // Make a Vector copy of $v
  $v2 = $v->toVector();

  // Modify the original Vector $v's inner Vector by adding an element
  $v[1]->add(4);

  // The original Vector $v's inner Vector includes 4.
  \var_dump($v);

  // The new Vector $v2's inner Vector also includes 4. toVector() only does a shallow copy.
  \var_dump($v2);
}
