<?hh // partial
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
use namespace HH\Lib\{Math, Str};
use namespace HH\Lib\Experimental\{File, IO};

final class HHVMDocumentationSite {
  public static async function respondToAsync(
    ServerRequestInterface $request,
  ): Awaitable<void> {
    // TODO: add Filesystem\temporary_file_non_disposable() to the HSL
    $buffer_path = \sys_get_temp_dir().'/'.\bin2hex(\random_bytes(16));
    $write_handle = File\open_write_only_nd(
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
    await $write_handle->closeAsync();
    await using ($read_handle = File\open_read_only($buffer_path)) {
      $out = IO\request_output();
      $content = await $read_handle->readAsync(Math\INT64_MAX);
      await $out->writeAsync($content);
      await $out->flushAsync();
    }
    ;
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
        // Try to add/remove trailing slash if we couldn't find a controller
        $orig_uri = $request->getUri();
        $orig_path = $orig_uri->getPath();
        $alt_path = Str\ends_with($orig_path, '/')
          ? Str\strip_suffix($orig_path, '/')
          : $orig_path.'/';
        $alt_request = $request->withUri($orig_uri->withPath($alt_path));

        try {
          list($controller, $vars) = self::routeRequest($alt_request);
          // If we're here, it's routable with a trailing /
          return await (
            new RedirectException($alt_path)
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
