// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassFull;

class Foo { /* user code in here */ }

class MyKeyType extends Key<Foo> { 
  public function coerceTo(mixed $data): Foo {
    // user code validation
    return $data as Foo;
  }  
}

enum class MyKeys : IKey extends EKeys {
  Key<int> AGE = new IntKey('AGE');
  MyKeyType BLI = new MyKeyType('BLI');
}

class MyDict extends DictBase {
  const type TKeys = MyKeys;
}

<<__EntryPoint>>
function main() : void {
  \init_docs_autoloader();

  $d = new MyDict();
  $d->set(MyKeys::NAME, 'tony');
  $d->set(MyKeys::BLI, new Foo());
  // $d->set(MyKeys::AGE, new Foo()); // type error
  expect_string($d->get(MyKeys::NAME) as nonnull);
}
