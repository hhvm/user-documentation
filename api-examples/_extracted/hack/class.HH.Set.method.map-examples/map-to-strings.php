<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodMap\MapToStrings;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $s = Set {'red', 'green', 'blue', 'yellow'};

  $capitalized = $s->map(fun('strtoupper'));
  \var_dump($capitalized);

  $shortened = $s->map($color ==> \substr($color, 0, 3));
  \var_dump($shortened);
}
