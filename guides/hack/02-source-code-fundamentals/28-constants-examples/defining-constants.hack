<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SourceCodeFundamentals\Constants\DefiningConstants;

const int MAX_COUNT = 123;
class C {
  const float MAX_HEIGHT = 10.5;
  const float UPPER_LIMIT = C::MAX_HEIGHT;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  echo "MAX_COUNT = ".MAX_COUNT."\n";
  echo "MAX_HEIGHT = ".C::MAX_HEIGHT."\n";
}
