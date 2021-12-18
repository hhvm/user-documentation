// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Enum\IsValid;

enum Bits: int {
  B1 = 2;
  B2 = 4;
  B3 = 8;
 }

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  \var_dump(Bits::isValid(2));
  \var_dump(Bits::isValid(2.0));
  \var_dump(Bits::isValid("2.0"));
  \var_dump(Bits::isValid(8));
}
