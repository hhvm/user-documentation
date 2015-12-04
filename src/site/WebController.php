<?hh // strict

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

<<__ConsistentConstruct>>
abstract class WebController {
  private ImmMap<string, string> $parameters;

  public function __construct(
    ImmMap<string,string> $parameters,
    private ServerRequestInterface $request,
  ) {
    $combined_params = $parameters->toMap();
    foreach ($request->getQueryParams() as $key => $value) {
      if (is_array($value)) {
        continue;
      }
      $combined_params[(string) $key] = (string) $value;
    }
    $this->parameters = $combined_params->toImmMap();
  }

  abstract public function getResponse(): Awaitable<ResponseInterface>;

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

  final protected function getRequestedPath(): string {
    return $this->request->getUri()->getPath();
  }

  final protected function getRequestedHost(): string {
    return $this->request->getUri()->getHost();
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
