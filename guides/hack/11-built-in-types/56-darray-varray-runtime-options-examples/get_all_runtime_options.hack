<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\DarrayVarrayRuntimeOptions\GetAllRuntimeOptions;

use namespace HH\Lib\{Dict, Str};

function get_all_runtime_options(
): dict<string, shape(
  'global_value' => string,
  'local_value' => string,
  'access' => string,
)> {
  return \ini_get_all()
    |> Dict\filter_keys($$, $name ==> Str\contains($name, 'hack_arr'));
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();

  foreach (get_all_runtime_options() as $name => $values) {
    echo Str\format(
      "%s> global_value(%s), local_value(%s), access(%s)\n",
      Str\pad_right($name, 60, '-'),
      $values['global_value'],
      $values['local_value'],
      $values['access'],
    );
  }
}
