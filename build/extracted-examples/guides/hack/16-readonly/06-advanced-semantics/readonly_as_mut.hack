// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\AdvancedSemantics\ReadonlyAsMut;

<<file:__EnableUnstableFeatures("readonly")>>

class Foo {
  public function __construct(
    public int $prop,
  ) {}

  public readonly function get() : int {
    $result = $this->prop; // here, $result is readonly, but its also an int.
    return \HH\Readonly\as_mut($this->prop); // convert to a non-readonly value
  }
}
