// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Shapes\ShapeValuesOfType;

function takes_server(Server $s): void {
  return;
}

function test(): void {
  $args = shape('name' => 'hello', 'age' => 10);
  $output = takes_server($args); // no error

  $args = shape('name' => null, 'age' => 10);
  $output = takes_server($args); // typechecker error: type mismatch

  $args = shape('name' => 'hello', 'age' => 10, 'error' => true);
  $output = takes_server($args); // typechecker error: we have an extra field
}
