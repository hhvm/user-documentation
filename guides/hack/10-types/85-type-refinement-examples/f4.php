<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Types\TypeRefinement\F4;

function f4(?num $p): void {
  if (($p is int) || ($p is float)) {
    //    $x = $p**2;    // rejected
  }
}
