// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Shapes\ShapeValuesOfType;

use type \HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Shapes\ShapeValuesOfTypeDefineServer\Server;

function takes_server(Server $s): void {
  return;
}

function test(): void {
  $args = shape('name' => 'hello', 'age' => 10);
  takes_server($args); // no error

  $args = shape('name' => null, 'age' => 10);
  /* HH_FIXME[4110] Typechecker error: type mismatch */
  takes_server($args);

  $args = shape('name' => 'hello', 'age' => 10, 'error' => true);
  /* HH_FIXME[4057] Typechecker error: we have an extra field */
  takes_server($args);
}
