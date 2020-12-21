// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Arrays\DictColors;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $colors = dict[]; // create an empty dict
  \var_dump($colors);

  $colors[4] = "black"; // create element 4 with value "black"
  \var_dump($colors);

  $colors[4] = "red"; // replace element 4's value with "red"
  $colors[8] = "white"; // create element 8 with value "white"
  $colors[-3] = "blue"; // create element -3 with value "blue"
  \var_dump($colors);

  $colors = dict[
    -10 => "white",
    12 => "blue",
    0 => "red",
  ]; // create a dict with 3 elements
  \var_dump($colors);
}
