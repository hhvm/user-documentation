// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SourceCodeFundamentals\Variables\LocalVariables;

function f(): void {
  $lv = 1;
  echo "\$lv = $lv\n";
  ++$lv;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  for ($i = 1; $i <= 3; ++$i)
    f();
}
