// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibCLast\BasicUsage;

use namespace HH\Lib\C;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $strings = vec["a", "b", "c"];
  $last_string = C\last($strings);
  echo "Last string in traversable: $last_string \n";

  $empty_traversable = vec[];
  $last_element = C\last($empty_traversable);
  $last_element_as_string = $last_element ?? "null";
  echo "Last element in empty traversable: $last_element_as_string";
}
