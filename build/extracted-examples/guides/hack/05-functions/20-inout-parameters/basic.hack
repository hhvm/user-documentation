// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Functions\InoutParameters\Basic;

function takes_inout(inout int $x): void {
  $x = 1;
}

function call_it(): void {
  $num = 0;
  takes_inout(inout $num);

  // $num is now 1.
}
