<?hh // strict

<<__ConsistentConstruct>>
abstract class WebController {
  public function __construct(
    private ImmMap<string,string> $parameters,
  ) {
  }

  abstract public function respond(): Awaitable<void>;

  protected function getRequiredStringParam(string $key): string {
    invariant(
      $this->parameters->containsKey($key),
      'required parameter %s is not set',
      $key,
    );
    return $this->parameters[$key];
  }

  protected static function invariantTo404<T>(
    (function():T) $what,
  ) :T {
    try {
      return $what();
    } catch (/* HH_FIXME[2049] */ \HH\InvariantException $e) {
      throw new HTTPNotFoundException(
        $e->what,
        $e->code,
        $e
      );
    }
  }
}
