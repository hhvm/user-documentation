<?hh // strict

use HHVM\UserDocumentation\BuildPaths;

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
    // Might seem overkill for a non-user-controlled cache key, but I don't want
    // to worry about forgetting about it if user input ever ends up in here.
    return hash('sha256', $key.'!!!'.__CLASS__.'!!!'.self::getBuildID());
  }

  <<__Memoize>>
  private static function getBuildID(): string {
    return trim(file_get_contents(BuildPaths::BUILD_ID));
  }
}
