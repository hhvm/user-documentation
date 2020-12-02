<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodLastValue\BasicUsage;

function echoLastValue(Vector<string> $v): void {
  $last_value = $v->lastValue();
  if ($last_value !== null) {
    echo 'Last value: '.$last_value."\n";
  } else {
    echo 'No last value (Vector is empty)'."\n";
  }
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  // Will print "Last value: yellow"
  echoLastValue(Vector {'red', 'green', 'blue', 'yellow'});

  // Will print "No last value (Vector is empty)"
  echoLastValue(Vector {});
}
