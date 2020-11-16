<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Float\Average;

function average_float(float $p1, float $p2): float {
  return ($p1 + $p2) / 2.0;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $val = 3e6;
  $result = average_float($val, 5.2E-2);
  echo "\$result is ".$result."\n";
}
