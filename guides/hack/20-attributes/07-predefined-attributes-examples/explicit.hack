// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Attributes\PredefinedAttributes\Explicit;

function values_are_equal<<<__Explicit>> T>(T $x, T $y): bool {
  return $x === $y;
}

function example_usage(int $x, int $y, string $s): void {
  values_are_equal<int>($x, $y);

  // Without <<__Explicit>>, this code would be fine, even though
  // it always returns false.
  /* HH_FIXME[4347] Demonstrating the error. */
  values_are_equal($x, $s);
}
