<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

use function HHVM\UserDocumentation\{
  cidr_to_bitstring_and_bitmask,
  is_fb_ip_address,
  is_ip_in_range,
};
use type Facebook\HackRouter\{RequestParameter, RequestParameters};
use type Facebook\TypeAssert\IncorrectTypeException;
use type Facebook\Experimental\Http\Message\ResponseInterface;
use type Facebook\Experimental\Http\Message\ServerRequestInterface;
use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Str, Vec};
use namespace HH\Lib\Experimental\IO;

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

  abstract public function getResponseAsync(
    ResponseInterface $response
  ): Awaitable<ResponseInterface>;

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
      throw new RedirectException($uri->withScheme('https')->toString());
    }
  }

  protected function isFacebookIP(): bool {
    $ip = $this->getRemoteIPAddress();
    if ($ip === null) {
      return false;
    }
    return is_fb_ip_address($ip);
  }

  <<__Memoize>>
  private function getRemoteIPAddress(): ?string {
    $ip = $this->request->getServerParams()['REMOTE_ADDR'] ?? null;
    if ($ip === null) {
      return null;
    }
    $ip = (string) $ip;
    $stack = ($this->request->getServerParams()['HTTP_X_FORWARDED_FOR'] ?? '')
      |> Str\split((string) $$, ',')
      |> Vec\map($$, $part ==> Str\trim($part))
      |> Vec\filter($$, $part ==> !Str\is_empty($part));
    $stack[] = $ip;
    while (!C\is_empty($stack)) {
      $top = C\lastx($stack);
      if (!self::isTrusted($top)) {
        return $top;
      }
      $ip = $top;
      $stack = Vec\take($stack, C\count($stack) - 1);
    }

    return $ip;
  }

  private static function isTrusted(string $ip): bool {
    return C\any(
      self::getTrustedRanges(),
      $range ==> is_ip_in_range($ip, $range),
    );
  }

  <<__Memoize>>
  private static function getTrustedRanges(): vec<(string, string)> {
    return HHVM\UserDocumentation\apc_fetch_or_set_method_data(
      self::class,
      __FUNCTION__,
      () ==> Vec\map(
        vec[
          '10.0.0.0/8',
          '172.16.0.0/12',
          '192.168.0.0/16',
          '127.0.0.0/8',
        ],
        $range ==> cidr_to_bitstring_and_bitmask($range),
      ),
    );
  }
}
