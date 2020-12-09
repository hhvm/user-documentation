<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodReserve\BasicUsage;

const int MAP_SIZE = 1000;

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  $m = Map {};
  $m->reserve(MAP_SIZE);

  for ($i = 0; $i < MAP_SIZE; $i++) {
    $m[$i] = $i * 10;
  }

  \var_dump($m);
}
