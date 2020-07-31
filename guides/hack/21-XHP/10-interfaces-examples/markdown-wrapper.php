<?hh // partial

class ExampleMarkdownXHPWrapper implements XHPUnsafeRenderable {
  private string $html;
  public function __construct(string $markdown_source) {
    $this->html = HHVM\UserDocumentation\XHP\Examples\md_render(
      $markdown_source,
    );
  }

  public function toHTMLString(): string {
    return $this->html;
  }
}

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
