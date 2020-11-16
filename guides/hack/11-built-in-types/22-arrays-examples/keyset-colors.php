<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Arrays\KeysetColors;

<<__EntryPoint>>
function _main(): void {
  \init_docs_autoloader();

  $colors = keyset[]; // create an empty keyset
  \var_dump($colors);

  $colors[] = "red"; // add element with key/value "red"
  $colors[] = "white"; // add element with key/value "white"
  $colors[] = "blue"; // add element with key/value "blue"
  \var_dump($colors);

  $colors = keyset[
    "green",
    "yellow",
    "green",
  ]; // create a keyset of two elements
  \var_dump($colors);

  echo "\$colors[\"green\"] = ".$colors["green"]."\n";
}
