// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibCFind\BasicUsage;

use namespace HH\Lib\C;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $strings= vec["a", "b", "c", "d"];
  $predicate_string_1 = C\find($strings, $x ==> $x == "b");
  echo "First predicate: $predicate_string_1 \n";

  $predicate_string_2 = C\find($strings, $x ==> $x == "z");
  $predicate_string_2_as_string = $predicate_string_2 ?? "null";
  echo "Second predicate: $predicate_string_2_as_string\n";

  $repeat_strings= vec["a1", "b", "a2", "d"];
  $predicate_string_3 = C\find($repeat_strings, $x ==> ($x == "a1" || $x == "a2"));
  echo "Repeat_predicate: $predicate_string_3";
}
