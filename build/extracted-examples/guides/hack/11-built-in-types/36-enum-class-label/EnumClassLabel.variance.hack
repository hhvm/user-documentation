// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClassLabel\EnumClassLabel;

newtype MemberOf<-TEnumClass, +TType> as TType = TType;
newtype Label<-TEnumClass, TType> = mixed;

class A {}
class B extends A {}
enum class G: A {
  A X = new A();
  B Y = new B();
}
