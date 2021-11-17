// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Readonly\Syntax\ReadonlyProps;

<<file:__EnableUnstableFeatures("readonly")>>
class Bar {}
class Foo {
  private static readonly ?Bar $static_bar = null;
  public function __construct(
    private readonly Bar $bar,
  ){}
}
