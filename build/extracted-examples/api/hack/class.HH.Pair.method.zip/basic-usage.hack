// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Api\Hack\ClassHHPairMethodZip\BasicUsage;

<<__EntryPoint>>
async function _main(): Awaitable<void> {
  \init_docs_autoloader();

  $p = Pair {'foo', -1.5};

  $labels = Vector {'First Value', 'Second Value'};
  $labeled = $p->zip($labels);

  foreach ($labeled as list($value, $label)) {
    echo $label.': '.(string)$value."\n";
  }
}
