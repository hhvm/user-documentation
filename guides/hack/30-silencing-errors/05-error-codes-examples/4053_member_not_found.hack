<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\MemberNotFound;

class MyClass {}

function takes_myclass(MyClass $c): void {
  /* HH_FIXME[4053] No such method. */
  $c->someMethod();
  /* HH_FIXME[4053] No such property. */
  $x = $c->someProperty;
}
