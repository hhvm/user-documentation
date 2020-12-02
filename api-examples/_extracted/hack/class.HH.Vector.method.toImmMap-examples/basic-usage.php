<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodToImmMap\BasicUsage;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  $imm_map = $v->toImmMap();

  \var_dump($imm_map is \HH\ImmMap<_, _>);
  \var_dump($imm_map->keys());
  \var_dump($imm_map);
}
