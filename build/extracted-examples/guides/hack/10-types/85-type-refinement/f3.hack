// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Types\TypeRefinement\F3;

function f3(?int $p): void {
  if (!$p is null) { // type refinement occurs; $p has type int
    $x = $p % 3; // accepted; % defined for int
  }

  if ($p is nonnull) { // type refinement occurs; $p has type int
    $x = $p % 3; // accepted; % defined for int
  }
}
