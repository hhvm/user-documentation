<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHShapesMethodKeyExists\BasicUsage;

function run(shape(?'x' => ?int, ?'y' => ?int, ?'z' => ?int) $point): void {
  // The key 'x' exists in Shape $point
  \var_dump(Shapes::keyExists($point, 'x'));

  // The key 'z' doesn't exist in $point
  \var_dump(Shapes::keyExists($point, 'z'));

  // The key 'y' exists in $point, even though its value is NULL
  \var_dump(Shapes::keyExists($point, 'y'));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  run(shape('x' => 3, 'y' => null));
}
