// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\TraitsAndInterfaces\TraitAndInterfaceRequirements\Requireclassgood;

<<file:__EnableUnstableFeatures('require_class')>>

trait T {
  require class C;

  public function foo(): void {
    $this->bar();
  }
}

final class C {
  use T;

  public function bar(): void {}
}
