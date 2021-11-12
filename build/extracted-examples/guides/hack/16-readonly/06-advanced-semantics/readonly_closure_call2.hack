// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\AdvancedSemantics\ReadonlyClosureCall2;

function readonly_closure_call2<T>(
  (function (): T) $regular_f,
  (readonly function(): T) $ro_f,
  ) : void {
    $ro_regular_f = readonly $regular_f; // readonly (function(): T)
    $ro_regular_f(); // error, $ro_regular_f is a readonly reference to a regular function
    $ro_ro_f = readonly $ro_f; // readonly (readonly function(): T)
    $ro_ro_f(); // safe
  }
