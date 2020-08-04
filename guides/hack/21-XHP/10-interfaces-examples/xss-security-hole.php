<?hh // partial

namespace Hack\UserDocumentation\XHP\MarkdownWrapper;

use type Facebook\XHP\HTML\div;

<<__EntryPoint>>
async function start(): Awaitable<void> {
  \init_docs_autoloader();
  $xhp =
    <div class="markdown">
      {new ExamplePotentialXSSSecurityHole(
        md_render('Markdown goes here'),
      )}
    </div>;
  echo await $xhp->toStringAsync();
}
