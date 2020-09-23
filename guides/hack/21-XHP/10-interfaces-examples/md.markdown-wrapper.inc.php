<?hh // partial

namespace Hack\UserDocumentation\XHP\MarkdownWrapper;

use namespace Facebook\XHP;

final class ExampleMarkdownXHPWrapper implements XHP\UnsafeRenderable {
  private string $html;

  public function __construct(string $markdown_source) {
    $this->html = md_render($markdown_source);
  }

  public async function toHTMLStringAsync(): Awaitable<string> {
    return $this->html;
  }
}
