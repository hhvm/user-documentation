<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodMap\MapToStrings;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $capitalized = $v->map(fun('strtoupper'));
  \var_dump($capitalized);

  $shortened = $v->map($color ==> \substr($color, 0, 3));
  \var_dump($shortened);
}
