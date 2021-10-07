// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\String\CharacterOps;

use namespace HH\Lib\{Locale,Str};

<<__EntryPoint>>
function main(): void {
  \init_docs_autoloader();

  $haystack = "abc\u{00e9}"; // ends with UTF-8 "LATIN SMALL LETTER E ACUTE"
  $needle = "\u{0065}\u{0301}"; // "LATIN SMALL LETTER E", "COMBINING ACUTE ACCENT"
  $locale = Locale\create("en_US.UTF-8");
  \var_dump(dict[
    'Byte test' => Str\ends_with($haystack, $needle), // false
    'Character test' => Str\ends_with_l($locale, $haystack, $needle), // true
    'Strip byte suffix' => Str\strip_suffix($haystack, $needle), // no change
    'Strip character suffix' => Str\strip_suffix_l($locale, $haystack, $needle), // removed
  ]);
}
