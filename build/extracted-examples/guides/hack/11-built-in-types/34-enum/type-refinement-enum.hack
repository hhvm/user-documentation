// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Enum\TypeRefinementEnum;

enum MyEnum: int {
  FOO = 1;
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

1 is MyEnum; // true
1 as MyEnum; // 1

42 is MyEnum; // false
42 as MyEnum; // TypeAssertionException

'foo' is MyEnum; // false
'foo' as MyEnum; // TypeAssertionException

'1' is MyEnum; // CAUTION - true
'1' as MyEnum; // CAUTION - '1'
}
