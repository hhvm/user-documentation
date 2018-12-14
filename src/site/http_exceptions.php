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

use type Facebook\Experimental\Http\Message\{
  ResponseInterface,
  ServerRequestInterface,
};

abstract class HTTPException extends \Exception {
  abstract public function getResponseAsync(
    ServerRequestInterface $request,
    ResponseInterface $response,
  ): Awaitable<ResponseInterface>;
}
abstract class RoutingException extends HTTPException {}

final class HTTPNotFoundException extends RoutingException {
  <<__Override>>
  public async function getResponseAsync(
    ServerRequestInterface $request,
    ResponseInterface $response,
  ): Awaitable<ResponseInterface> {
    return await (new HTTP404Controller(ImmMap {}, $request))->getResponseAsync(
      $response,
    );
  }
}

final class HTTPMethodNotAllowedException extends RoutingException {
  <<__Override>>
  public async function getResponseAsync(
    ServerRequestInterface $_,
    ResponseInterface $response,
  ): Awaitable<ResponseInterface> {
    return $response->withStatus(405);
  }
}

final class RedirectException extends HTTPException {
  public function __construct(private string $destination) {
    parent::__construct();
  }

  <<__Override>>
  public async function getResponseAsync(
    ServerRequestInterface $_,
    ResponseInterface $response,
  ): Awaitable<ResponseInterface> {
    return $response
      ->withStatus(301)
      ->withHeader('Location', vec[$this->destination]);
  }
}
