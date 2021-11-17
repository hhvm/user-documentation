// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\AdvancedSemantics\ReadonlyAdvancedClosures;

<<file:__EnableUnstableFeatures("readonly")>>

function readonly_closures_example2<T>(
  (function (): T) $regular_f,
  (readonly function(): T) $ro_f,
) : void {
  $ro_regular_f = readonly $regular_f; // readonly (function(): T)
  $ro_f; // (readonly function(): T)
  $ro_ro_f = readonly $ro_f; // readonly (readonly function(): T)
}
