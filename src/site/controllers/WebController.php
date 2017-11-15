<?hh // strict

use type Facebook\HackRouter\{RequestParameter, RequestParameters};
use type Facebook\TypeAssert\IncorrectTypeException;
use type Psr\Http\Message\ResponseInterface;
use type Psr\Http\Message\ServerRequestInterface;
use namespace Facebook\TypeAssert;

<<__ConsistentConstruct>>
abstract class WebController {
  const type TParameterDefinitions = shape(
    'required' => ImmVector<RequestParameter>,
    'optional' => ImmVector<RequestParameter>,
  );

  private RequestParameters $parameters;
  private ImmMap<string, string> $rawParameters;

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

    $spec = self::getParametersSpec();
    $this->parameters = new RequestParameters(
      $spec['required'],
      $spec['optional'],
      $combined_params->immutable(),
    );
    $this->rawParameters = $combined_params->immutable();
  }

  final public static function getParametersSpec(
  ): self::TParameterDefinitions {
    $uri = self::getUriParametersSpec();
    $extra = static::getExtraParametersSpec();
    return shape(
      'required' => $uri['required']->concat($extra['required']),
      'optional' => $uri['optional']->concat($extra['optional']),
    );
  }

  /** Use the codegen traits instead */
  final protected function getParameters_PRIVATE_IMPL(): RequestParameters {
    return $this->parameters;
  }

  final private static function getUriParametersSpec(
  ): self::TParameterDefinitions {
    try {
      $class = TypeAssert\classname_of(
        RoutableController::class,
        static::class,
      );
    } catch (IncorrectTypeException $e) {
      return shape('required' => ImmVector {}, 'optional' => ImmVector {});
    }
    return shape(
      'required' => $class::getUriPattern()->getParameters(),
      'optional' => ImmVector {},
    );
  }

  protected static function getExtraParametersSpec(
  ): self::TParameterDefinitions {
    return shape('required' => ImmVector {}, 'optional' => ImmVector {});
  }

  abstract public function getResponse(): Awaitable<ResponseInterface>;

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

  final protected function getRawParameter_UNSAFE(string $name): ?string {
    $params = $this->rawParameters;
    if (!$params->containsKey($name)) {
      return null;
    }
    return $params->at($name);
  }

  protected function requireSecureConnection(): void {
    $uri = $this->request->getUri();
    if ($uri->getScheme() !== 'https') {
      throw new RedirectException((string) $uri->withScheme('https'));
    }
  }
}
