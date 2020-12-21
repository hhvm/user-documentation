// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\UndefField;

function foo(shape('x' => int) $s): void {
  /* HH_FIXME[4108] No such field in this shape. */
  $value = $s['not_x'];
}
