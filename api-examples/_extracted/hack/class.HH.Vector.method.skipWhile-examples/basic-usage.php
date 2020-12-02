<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodSkipWhile\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144};

  // Skip values until we reach one over 10
  $v2 = $v->skipWhile($x ==> $x <= 10);
  \var_dump($v2);
}
