// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\OptionalField;

function foo(shape(?'x' => int) $s): void {
  /* HH_FIXME[4165] This field may not be present. */
  $value = $s['x'];
}
