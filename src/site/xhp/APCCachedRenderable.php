<?hh // strict

class APCCachedRenderable implements \XHPUnsafeRenderable, \XHPAlwaysValidChild {
  private function __construct(
    private string $str,
  ) {
  }

  public function toHTMLString(): string {
    return $this->str;
  }

  public static function get(string $key): ?\XHPRoot {
    $str = apc_fetch(self::makeKey($key));
    if (is_string($str)) {
      $ret = <x:frag>{new APCCachedRenderable($str)}</x:frag>;
      return $ret;
    }
    return null;
  }

  public static function store(string $key, \XHPRoot $content): void {
    $str = $content->toString();
    $key = self::makeKey($key);
    apc_store($key, $str);
  }

  private static function makeKey(string $key): string {
    return $key.'!!!'.__CLASS__.'!!!';
  }
}
