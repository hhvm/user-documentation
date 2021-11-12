// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\AdvancedSemantics\ReadonlyClosureCall;

function readonly_closure_call<T>(
  (function (): T) $regular_f,
  (readonly function(): T) $ro_f,
) : void {
  $ro_regular_f = readonly $regular_f; // readonly (function(): T)
  $ro_regular_f(); // error, $ro_regular_f is a readonly reference to a regular function
}
