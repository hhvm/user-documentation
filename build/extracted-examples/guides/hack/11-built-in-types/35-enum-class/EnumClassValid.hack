// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassValid;

enum class Foo: string {
  string BAR = 'BAZ';
}

function do_stuff(Foo $value): void {
  var_dump($value);
}

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  do_stuff(Foo::BAR); // Ok
}
