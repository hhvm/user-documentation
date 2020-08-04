<?hh // partial

use namespace Facebook\XHP;

final class XHPUnsafeExample implements XHP\UnsafeRenderable {
  public async function toHTMLStringAsync(): Awaitable<string> {
    return '<script>'.$_GET['I_LOVE_XSS'].'</script>';
  }
}
