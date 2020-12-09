<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\MethodsWithPredefinedSemantics\MyRangeException;

class MyRangeException extends \Exception {
  public function __toString(): string {
    return parent::__toString().">>MyRangeException stuff<<";
  }
  // ...
}
