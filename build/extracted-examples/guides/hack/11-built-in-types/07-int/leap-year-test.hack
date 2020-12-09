// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Int\LeapYearTest;

function is_leap_year(int $yy): bool {
  return ((($yy & 3) === 0) && (($yy % 100) !== 0)) || (($yy % 400) === 0);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $year = 2001;
  $result = is_leap_year($year);
  echo "$year is ".(($result === true) ? "" : "not ")."a leap year\n";
}
