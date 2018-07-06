<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

use Facebook\HackRouter as HackRouter;
use type Psr\Http\Message\ResponseInterface;
use type Psr\Http\Message\ServerRequestInterface;
use type Zend\Diactoros\Response\SapiEmitter;

final class HHVMDocumentationSite {
  public static async function respondToAsync(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    $response = await self::getResponseForRequestAsync($request);
    /* HH_IGNORE_ERROR[2049] no HHI for Diactoros */
    (new SapiEmitter())->emit($response);
  }

  private static function routeRequest(
    ServerRequestInterface $request,
  ): (classname<RoutableController>, ImmMap<string, string>) {
    try {
      return (new Router())->routePsr7Request($request);
    } catch (HackRouter\NotFoundException $e) {
      throw new HTTPNotFoundException('', 0, $e);
    } catch (HackRouter\MethodNotAllowedException $e) {
      throw new HTTPMethodNotAllowedException('', 0, $e);
    }
  }

  public static async function getResponseForRequestAsync(
    ServerRequestInterface $request,
  ): Awaitable<ResponseInterface> {
    try {
      try {
        list($controller, $vars) = self::routeRequest($request);
      } catch (HTTPNotFoundException $e) {
        // Try to add trailing if we couldn't find a controller
        $orig_uri = $request->getUri();
        $with_trailing_slash = $request
          ->withUri($orig_uri->withPath($orig_uri->getPath().'/'));

        try {
          list($controller, $vars) = self::routeRequest($with_trailing_slash);
          // If we're here, it's routable with a trailing /
          return await (new RedirectException(
            $with_trailing_slash->getUri()->getPath()
          ))->getResponseAsync($request);
        } catch (HTTPException $f) {
          throw $e; // original exception, not the new one
        }
      }

      // This is outside of the try so that we don't try adding a trailing
      // slash if the controller itself throws a 404
      return await (new $controller($vars, $request))->getResponseAsync();
    } catch (HTTPException $e) {
      return await $e->getResponseAsync($request);
    }
  }
}
