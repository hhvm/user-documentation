<?hh // partial

<<__EntryPoint>>
function run(): void {
  \__init_autoload();

  require_once __DIR__.'/md_render.inc.php';
  echo (
    /* HH_FIXME[4067] implicit __toString() is now deprecated */
    <div class="markdown">
      {new ExampleMarkdownXHPWrapper('Markdown goes here')}
    </div>
  ).
    "\n";
}
