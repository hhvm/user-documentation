// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\XhpChild;

use type Facebook\XHP\HTML\div;

function foo(mixed $m): void {
  /* HH_FIXME[4110] */ /* HH_FIXME[4193] $m may not be an XHPChild.*/
  $my_div = <div>{$m}</div>;
}
