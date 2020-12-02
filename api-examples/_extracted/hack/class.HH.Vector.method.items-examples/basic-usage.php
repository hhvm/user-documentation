<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\ClassHHVectorMethodItems\BasicUsage;

<<__EntryPoint>>
function basic_usage_main(): void {
  \init_docs_autoloader();

  $v = Vector {'red', 'green', 'blue', 'yellow'};

  // Get an Iterable view of the Vector
  $iterable = $v->items();

  // Add another color to the original Vector $v
  $v->add('purple');

  // Print each color using $iterable
  foreach ($iterable as $color) {
    echo $color."\n";
  }
}

// This wouldn't work because the Iterable interface is read-only:
// $iterable->add('orange');
