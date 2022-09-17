// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hsl\FunctionHHLibDictSelectKeys\BasicUsage;

use namespace HH\Lib\Dict;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $dict_with_all_keys = dict["key1" => "value 1", "key2" => "value 2", "key3" => "value 3"];

  $present_required_keys = vec["key1"];
  $keys_not_present_in_dict = vec["incorrect_keys"];

  $dict_with_present_keys = Dict\select_keys($dict_with_all_keys, $present_required_keys);
  echo"Result when keys present in dict: \n";
  \print_r($dict_with_present_keys);

  $dict_with_keys_not_present = Dict\select_keys($dict_with_all_keys, $keys_not_present_in_dict);
  echo"Result when keys not present in dict: \n";
  \print_r($dict_with_keys_not_present);
}
