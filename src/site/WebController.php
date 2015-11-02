<?hh // strict

use Psr\Http\Message\RequestInterface;

<<__ConsistentConstruct>>
abstract class WebController {
  public function __construct(
    private ImmMap<string,string> $parameters,
    private RequestInterface $request,
  ) {
  }

  abstract public function respond(): Awaitable<void>;

  final protected function getRequiredStringParam(string $key): string {
    invariant(
      $this->parameters->containsKey($key),
      'required parameter %s is not set',
      $key,
    );
    return $this->parameters[$key];
  }

  final protected function getOptionalStringParam(string $key): ?string {
    return 
      $this->parameters->containsKey($key) 
        ? $this->parameters[$key] 
        : NULL;
  }
  
  protected static function invariantTo404<T>(
    (function():T) $what,
  ) :T {
    try {
      return $what();
    } catch (/* HH_FIXME[2049] */ \HH\InvariantException $e) {
      throw new HTTPNotFoundException(
        $e->getMessage(),
        $e->getCode(),
        $e
      );
    }
  }
}
