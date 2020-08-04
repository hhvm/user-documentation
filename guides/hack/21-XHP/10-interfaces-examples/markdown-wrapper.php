<?hh // partial

use type Facebook\XHP\HTML\div;

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  require_once __DIR__.'/md_render.inc.php';
  echo (
    /* HH_FIXME[4067] implicit __toString() is now deprecated */
    <div class="markdown">
      {new ExampleMarkdownXHPWrapper('Markdown goes here')}
    </div>
  ).
    "\n";
}
