// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\Nothing\Undefined;

interface MyInterface {
  public function isAmazed(): bool;
}

function do_something(MyInterface $my_interface): bool {
  return $my_interface->isAmazed();
}

<<__EntryPoint>>
async function main_async(): Awaitable<void> {
  \init_docs_autoloader();

  $my_interface = undefined();
  // We won't ever reach this line, since `undefined()` will halt the program by throwing.
  // We can't produce a MyInterface just yet, since there are no classes which implement it.
  // `undefined` is a placeholder for now.
  // We can continue writing our business logic and come back to this later.
  if (do_something($my_interface)) {
    // Write the body first, worry about the condition later.
  }
}
