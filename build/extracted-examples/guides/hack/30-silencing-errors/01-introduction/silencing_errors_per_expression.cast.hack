// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\Introduction\SilencingErrorsPerExpression;

function takes_float_with_unsafe_cast(float $i): float {
  /* HH_FIXME[4417] */
  return HH\FIXME\UNSAFE_CAST<int, float>(
    /* HH_FIXME[4417] */
    takes_int(HH\FIXME\UNSAFE_CAST<float, int>($i, 'wrong param type')),
    'returns wrong type',
  );
}
