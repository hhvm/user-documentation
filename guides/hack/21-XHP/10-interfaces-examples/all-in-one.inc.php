<?hh // partial

final class XHPUnsafeExample implements XHPUnsafeRenderable {
  public function toHTMLString(): string {
    return '<script>'.$_GET['I_LOVE_XSS'].'</script>';
  }
}
