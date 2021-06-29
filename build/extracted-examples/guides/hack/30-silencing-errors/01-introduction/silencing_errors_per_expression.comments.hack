// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\Introduction\SilencingErrorsPerExpression;

function takes_int(int $i): int {
  return $i + 1;
}

function takes_float(float $i): float {
  /* HH_FIXME[4110] calls takes_int with wrong
     param type AND returns wrong type */
  return takes_int($i);
}
