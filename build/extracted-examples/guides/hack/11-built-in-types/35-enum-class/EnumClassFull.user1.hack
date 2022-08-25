// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassFull;

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $d = new MyDict();
  $d->set(MyKeys::NAME, 'tony');
  $d->set(MyKeys::BLI, new Foo());
  // $d->set(MyKeys::AGE, new Foo()); // type error
  expect_string($d->get(MyKeys::NAME) as nonnull);
}
