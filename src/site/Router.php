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

use namespace Nuxed\Contract\Http\Message;
use namespace Facebook\HackRouter;

final class Router extends RouterCodegenBase {
  final public function match(
    Message\IServerRequest $request,
  ): (classname<\RoutableController>, ImmMap<string, string>) {
    $method = HackRouter\HttpMethod::coerce($request->getMethod());
    if ($method === null) {
      throw new HackRouter\MethodNotAllowedException(keyset[]);
    }

    return $this->routeMethodAndPath($method, $request->getUri()->getPath());
  }
}
