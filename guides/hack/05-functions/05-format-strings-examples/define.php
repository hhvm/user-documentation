<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Functions\FormatStrings\Define;

function takes_format_string(
  \HH\FormatString<\PlainSprintf> $format,
  mixed ...$args
): void {}

function use_it(): void {
  takes_format_string("First: %d, second: %s", 1, "foo");
}
