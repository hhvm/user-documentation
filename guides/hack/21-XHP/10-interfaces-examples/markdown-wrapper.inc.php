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
