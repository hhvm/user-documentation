<?hh // partial

<<__EntryPoint>>
function start(): void {
  \__init_autoload();

  require_once __DIR__.'/md_render.inc.php';
  echo (
    /* HH_FIXME[4067] implicit __toString() is now deprecated */
    <div class="markdown">
      {new ExamplePotentialXSSSecurityHole(
        HHVM\UserDocumentation\XHP\Examples\md_render('Markdown goes here'),
      )}
    </div>
  ).
    "\n";
}
