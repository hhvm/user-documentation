<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHShapesMethodIdx\BasicUsage;

function run(shape('x' => int, 'y' => int, ?'z' => int) $point): void {
  // The key 'x' exists in the Shape $point so it's returned
  \var_dump(Shapes::idx($point, 'x'));

  // The key 'z' doesn't exist in $point so the default NULL is returned
  \var_dump(Shapes::idx($point, 'z'));

  // The key 'z' doesn't exist in $point so our explicit default 0 is returned
  \var_dump(Shapes::idx($point, 'z', 0));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  run(shape('x' => 3, 'y' => -1));
}
