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

use HHVM\UserDocumentation\BuildPaths;
use HHVM\UserDocumentation\JumpIndexData;
use Psr\Http\Message\ResponseInterface;

require_once(BuildPaths::JUMP_INDEX);

final class JumpController
extends WebController
implements RoutableGetController {
  use JumpControllerParametersTrait;

  public static function getUriPattern(): UriPattern {
    return (new UriPattern())
      ->literal('/j/')
      ->string('Keyword');
  }

  public function getResponse(): Awaitable<ResponseInterface> {
    $keyword = $this->getParameters()['Keyword'];

    $data = JumpIndexData::getIndex();
    $url = idx($data, strtolower($keyword));
    if (is_string($url)) {
      throw new RedirectException($url);
    }

    throw new RedirectException(
      '/search?term='.urlencode($keyword)
    );
  }
}
