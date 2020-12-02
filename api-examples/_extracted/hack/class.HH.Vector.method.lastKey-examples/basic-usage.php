<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodLastKey\BasicUsage;

function echoLastKey(Vector<string> $v): void {
  $last_key = $v->lastKey();
  if ($last_key !== null) {
    echo 'Last key: '.$last_key."\n";
  } else {
    echo 'No last key (Vector is empty)'."\n";
  }
}

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  // Will print "Last key: 3"
  echoLastKey(Vector {'red', 'green', 'blue', 'yellow'});

  // Will print "No last key (Vector is empty)"
  echoLastKey(Vector {});
}
