// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\Introduction\SilencingErrorsPerExpression;

function takes_float(float $i): float {
  return HH\FIXME\UNSAFE_CAST<int, float>(
    takes_int(HH\FIXME\UNSAFE_CAST<float, int>($i, 'wrong param type')),
    'returns wrong type',
  );
}
