<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Functions\Introduction\Varargs;

function sum_ints(int $val, int ...$vals): int {
  $result = $val;
  
  foreach ($vals as $v) {
    $result += $v;
  }
  return $result;
}
