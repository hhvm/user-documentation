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

use HHVM\UserDocumentation\LegacyRedirects;
use Psr\Http\Message\ResponseInterface;

final class LegacyRedirectController
extends WebController
implements RoutableGetController {
  use LegacyRedirectControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/manual/en/')
      ->string('LegacyId')
      ->literal('.php');
  }

  <<__Override>>
  public async function getResponse(): Awaitable<ResponseInterface> {
    $id = $this->getParameters()['LegacyId'];

    $url = LegacyRedirects::getUrlForId($id);
    if ($url !== null) {
      throw new RedirectException($url);
    }

    throw new HTTPNotFoundException();
  }
}
