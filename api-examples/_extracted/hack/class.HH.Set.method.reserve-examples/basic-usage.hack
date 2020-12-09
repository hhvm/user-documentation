<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHSetMethodReserve\BasicUsage;

const int SET_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  $s = Set {};
  $s->reserve(SET_SIZE);

  for ($i = 0; $i < SET_SIZE; $i++) {
    $s[] = $i * 10;
  }

  \var_dump($s);
}
