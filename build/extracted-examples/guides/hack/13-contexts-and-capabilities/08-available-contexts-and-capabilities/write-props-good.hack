// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ContextsAndCapabilities\AvailableContextsAndCapabilities\WritePropsGood;

// Valid example

class SomeClass {
  public string $s = '';
  public function modifyThis()[write_props]: void {
    $this->s = 'this applies as well';
  }
}

function can_write_props(SomeClass $sc)[write_props]: void {
  $sc->s = 'like this';
  $sc2 = new SomeClass();
  $sc2->s = 'or like this';
}
