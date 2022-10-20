// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibCFirst\BasieUsage;

use namespace HH\Lib\C;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $strings = vec["a", "b", "c"];
  $first_string = C\first($strings);
  echo "First string in traversable: $first_string \n";

  $empty_traversable = vec[];
  $first_element = C\first($empty_traversable);
  $first_element_as_string = $first_element ?? "null";
  echo "First element in empty traversable: $first_element_as_string";
}
