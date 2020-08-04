<?hh // partial

use namespace Facebook\XHP;

final class ExampleMarkdownXHPWrapper implements XHP\UnsafeRenderable {
  private string $html;
  public function __construct(string $markdown_source) {
    $this->html = HHVM\UserDocumentation\XHP\Examples\md_render(
      $markdown_source,
    );
  }

  public async function toHTMLStringAsync(): Awaitable<string> {
    return $this->html;
  }
}
