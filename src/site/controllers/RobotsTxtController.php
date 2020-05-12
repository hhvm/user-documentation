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

use type HHVM\UserDocumentation\LocalConfig;
use namespace Nuxed\Contract\Http\Message;
use namespace Nuxed\Http\Message\Response;

final class RobotsTxtController
  extends WebController
  implements RoutableGetController {
  public static function getUriPattern(): UriPattern {
    return (new UriPattern())->literal('/robots.txt');
  }

  const string DO_NOT_CRAWL_FILE =
    LocalConfig::ROOT.'/public/robots.txt-do-not-crawl';
  const string DEFAULT_FILE = LocalConfig::ROOT.'/public/robots.txt-default';

  <<__Override>>
  public async function getResponseAsync(): Awaitable<Message\IResponse> {
    if ($this->getRequestedHost() === 'docs.hhvm.com') {
      return Response\text_file(self::DEFAULT_FILE);
    }

    return Response\text_file(self::DO_NOT_CRAWL_FILE);
  }
}
