<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHShapesMethodRemoveKey\BasicUsage;

function run(shape('x' => int, 'y' => int) $point): void {
  // Prints the value at key 'y'
  \var_dump($point['y']);

  Shapes::removeKey(inout $point, 'y');

  // Prints NULL because the key 'y' doesn't exist any more
  /* HH_IGNORE_ERROR[4251] typechecker knows the key doesn't exist */
  \var_dump(Shapes::idx($point, 'y'));
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  run(shape('x' => 3, 'y' => -1));
}
