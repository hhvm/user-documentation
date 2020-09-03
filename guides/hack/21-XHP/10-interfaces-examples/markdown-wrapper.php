<?hh // partial

namespace Hack\UserDocumentation\XHP\MarkdownWrapper;

use type Facebook\XHP\HTML\div;

<<__EntryPoint>>
async function run(): Awaitable<void> {
  \init_docs_autoloader();
  $xhp =
    <div class="markdown">
      {new ExampleMarkdownXHPWrapper('Markdown goes here')}
    </div>;
  echo await $xhp->toStringAsync();
}
