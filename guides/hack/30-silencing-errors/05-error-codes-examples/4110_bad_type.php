<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\SilencingErrors\ErrorCodes\BadType;

function takes_int(int $_): void {}

function foo(): void {
  /* HH_FIXME[4110] Passing incorrect type to a function. */
  takes_int("hello");
  /* HH_FIXME[4110] Addition on a value that isn't a num. */
  "1" + 3;
}
