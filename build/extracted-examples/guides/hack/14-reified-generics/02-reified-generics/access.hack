// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ReifiedGenerics\ReifiedGenerics\Access;

class C {
  const string class_const = "hi";
  public static function h<reify T>(): void {}
}

// Without reified generics
function f<T as C>(classname<T> $x): void {
  $x::class_const;
  $x::h<int>();
}

// With reified generics
function g<reify T as C>(): void {
  T::class_const;
  T::h<int>();
}
