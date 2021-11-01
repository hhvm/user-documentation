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

use namespace Facebook\HackRouter;
use type Facebook\Experimental\Http\Message\{
  ResponseInterface,
  ServerRequestInterface,
};
use namespace HH\Lib\{File, IO};

final class HHVMDocumentationSite {
  public static async function respondToAsync(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    // TODO: add Filesystem\temporary_file_non_disposable() to the HSL
    $buffer_path = \sys_get_temp_dir().'/'.\bin2hex(\random_bytes(16));
    $write_handle = File\open_write_only(
      $buffer_path,
      File\WriteMode::MUST_CREATE,
    );
    $response = (new \Usox\HackTTP\Response($write_handle));
    $response = await self::getResponseForRequestAsync($request, $response);
    \http_response_code($response->getStatusCode());
    foreach ($response->getHeaders() as $key => $values) {
      foreach ($values as $value) {
        \header($key.': '.$value, /* replace = */ false);
      }
    }
    $write_handle->close();
    $read_handle = File\open_read_only($buffer_path);
    using ($read_handle->closeWhenDisposed()) {
      $out = IO\request_output();
      $content = await $read_handle->readAllAsync();
      await $out->writeAllAsync($content);
    }
    \unlink($buffer_path);
  }

  private static function routeRequest(
    ServerRequestInterface $request,
  ): (classname<RoutableController>, ImmMap<string, string>) {
    try {
      return (new Router())->routeRequest($request);
    } catch (HackRouter\NotFoundException $e) {
      throw new HTTPNotFoundException('', 0, $e);
    } catch (HackRouter\MethodNotAllowedException $e) {
      throw new HTTPMethodNotAllowedException('', 0, $e);
    }
  }

  public static async function getResponseForRequestAsync(
    ServerRequestInterface $request,
    ResponseInterface $response,
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
          return await (
            new RedirectException($with_trailing_slash->getUri()->getPath())
          )->getResponseAsync($request, $response);
        } catch (HTTPException $f) {
          throw $e; // original exception, not the new one
        }
      }

      // This is outside of the try so that we don't try adding a trailing
      // slash if the controller itself throws a 404
      return await (new $controller($vars, $request))->getResponseAsync(
        $response,
      );
    } catch (HTTPException $e) {
      return await $e->getResponseAsync($request, $response);
    }
  }
}
