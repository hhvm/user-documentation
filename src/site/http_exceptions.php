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

use namespace Nuxed\Contract\Http;
use namespace Nuxed\Http\Message;
use namespace Nuxed\Http\Message\Response;

abstract class HTTPException extends \Exception {
  abstract public function getResponseAsync(
    Http\Message\IServerRequest $request,
  ): Awaitable<Http\Message\IResponse>;
}
abstract class RoutingException extends HTTPException {}

final class HTTPNotFoundException extends RoutingException {
  <<__Override>>
  public async function getResponseAsync(
    Http\Message\IServerRequest $request,
  ): Awaitable<Http\Message\IResponse> {
    return await (
      new HTTP404Controller(ImmMap {}, $request)
    )->getResponseAsync();
  }
}

final class HTTPMethodNotAllowedException extends RoutingException {
  <<__Override>>
  public async function getResponseAsync(
    Http\Message\IServerRequest $_request,
  ): Awaitable<Http\Message\IResponse> {
    return Response\empty()
      ->withStatus(Http\Message\StatusCode::MethodNotAllowed);
  }
}

final class RedirectException extends HTTPException {
  public function __construct(private string $destination) {
    parent::__construct();
  }

  <<__Override>>
  public async function getResponseAsync(
    Http\Message\IServerRequest $_request,
  ): Awaitable<Http\Message\IResponse> {
    return Response\redirect(
      Message\uri($this->destination),
      Http\Message\StatusCode::MovedPermanently,
    );
  }
}
