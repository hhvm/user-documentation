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

use type HHVM\UserDocumentation\JumpIndexData;
use type Facebook\Experimental\Http\Message\ResponseInterface;

final class JumpController
  extends WebController
  implements RoutableGetController {
  use JumpControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/j/')
      ->string('Keyword');
  }

  <<__Override>>
  public function getResponseAsync(
    ResponseInterface $_,
  ): Awaitable<ResponseInterface> {
    $keyword = $this->getParameters()['Keyword'];

    $data = JumpIndexData::getIndex();
    $url = idx($data, strtolower($keyword));
    if ($url is string) {
      throw new RedirectException($url);
    }

    throw new RedirectException('/search?term='.urlencode($keyword));
  }
}
