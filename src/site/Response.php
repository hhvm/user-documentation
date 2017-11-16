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

use \Psr\Http\Message\ResponseInterface;

abstract final class Response {

  public static function newEmpty(): ResponseInterface {
    /* HH_IGNORE_ERROR[2049] no HHI for Diactoros */
    return new \Zend\Diactoros\Response();
  }

  public static function newWithStringBody(string $body): ResponseInterface {
    /* HH_IGNORE_ERROR[2049] no HHI for Diactoros */
    $stream = new \Zend\Diactoros\Stream('php://temp', 'wb+');
    $stream->write($body);
    return self::newEmpty()->withBody($stream);
  }
}
