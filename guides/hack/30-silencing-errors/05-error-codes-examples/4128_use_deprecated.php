<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\UseDeprecated;

function foo_new(): void {}

<<__Deprecated("Use foo_new instead")>>
function foo_old(): void {}

function bar(): void {
  /* HH_FIXME[4128] Calling a deprecated function. */
  foo_old();
}
