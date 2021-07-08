// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ContextsAndCapabilities\AvailableContextsAndCapabilities\GlobalsGood;

// Valid example

class SomeClass {
  public static string $s = '';
  public function accessStatic()[globals]: void {
    self::$s; // like this
  }
}

function access_static()[globals]: void {
  SomeClass::$s; // or like this
}
