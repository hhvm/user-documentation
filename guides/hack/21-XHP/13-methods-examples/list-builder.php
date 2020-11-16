<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\XHP\Methods\ListBuilder;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{li, p, ul};

function build_list(vec<string> $names): x\node {
  $list = <ul id="names" />;
  foreach ($names as $name) {
    $list->appendChild(<li>{$name}</li>);
  }
  return $list;
}

<<__EntryPoint>>
async function xhp_object_methods_run(): Awaitable<void> {
  \init_docs_autoloader();

  $names = vec['Sara', 'Fred', 'Josh', 'Scott', 'Paul', 'David', 'Matthew'];

  foreach (build_list($names)->getChildren() as $child) {
    $child as x\node;
    echo 'Child: '.await $child->toStringAsync()."\n";
  }

  echo 'First child: '.
    await (build_list($names)->getFirstChild() as x\node->toStringAsync())."\n";

  echo 'Last child: '.
    await (build_list($names)->getLastChild() as x\node->toStringAsync())."\n";

  foreach (build_list($names)->getAttributes() as $name => $value) {
    echo 'Attribute '.$name.' = '.$value as string."\n";
  }

  echo 'ID: '.build_list($names)->getAttribute('id') as string."\n";
}
