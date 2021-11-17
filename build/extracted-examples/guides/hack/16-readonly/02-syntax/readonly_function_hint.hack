// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Syntax\ReadonlyFunctionHint;

<<file:__EnableUnstableFeatures("readonly")>>
class Bar {}
function call(
    (function(readonly Bar) : readonly Bar) $f,
    readonly Bar $arg,
   ) : readonly Bar {
   return readonly $f($arg);
}
