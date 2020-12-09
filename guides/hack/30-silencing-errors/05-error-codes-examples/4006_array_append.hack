// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\ArrayAppend;

function foo(mixed $m): void {
  /* HH_FIXME[4006] $m may not be an array. */
  $m[] = 1;
}
