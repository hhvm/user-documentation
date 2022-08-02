// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassIntro;

// Some class definitions to make a more involved example
interface IHasName {
  public function name(): string;
}

class HasName implements IHasName {
  public function __construct(private string $name)[] {}
  public function name(): string {
    return $this->name;
  }
}

class ConstName implements IHasName {
  public function name(): string {
    return "bar";
  }
}

// enum class which base type is the IHasName interface: each enum value
// can be any subtype of IHasName, here we see HasName and ConstName
enum class Names: IHasName {
  HasName Hello = new HasName('hello');
  HasName World = new HasName('world');
  ConstName Bar = new ConstName();
}
