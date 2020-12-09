<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\NullContainer;

function foo(?vec<int> $items): void {
  /* HH_FIXME[4063] $items can be null. */
  $x = $items[0];
}
