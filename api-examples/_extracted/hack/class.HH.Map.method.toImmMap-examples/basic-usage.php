<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHMapMethodToImmMap\BasicUsage;

function expects_immutable(ImmMap<string, string> $iv): void {
  \var_dump($iv);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  $m = Map {
    'red' => '#ff0000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
    'yellow' => '#ffff00',
  };

  // Get a deep, immutable copy of $m
  $immutable_map = $m->toImmMap();

  expects_immutable($immutable_map);
}
