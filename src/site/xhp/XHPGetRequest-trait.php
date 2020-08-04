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

namespace HHVM\UserDocumentation;

use namespace Facebook\XHP\Core as x;
use type Facebook\Experimental\Http\Message\ServerRequestInterface;

trait XHPGetRequest {
  require extends x\element;

  protected function getRequest(): ServerRequestInterface {
    $x = $this->getContext('ServerRequestInterface');
    invariant(
      $x is ServerRequestInterface,
      '%s is not a ServerRequestInterface',
      \gettype($x).' ('.\get_class($x).')',
    );
    return $x;
  }
}
