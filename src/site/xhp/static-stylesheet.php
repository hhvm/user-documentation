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

namespace HHVM\UserDocumentation\static_res;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\link;

final xhp class stylesheet extends base {
  attribute string media;

  <<__Override>>
  protected function getAllowedMimeTypes(): Set<string> {
    return Set {'text/css'};
  }

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $ret =
      <link
        rel="stylesheet"
        type={$this->getMimeType()}
        href={$this->getVersionedURL()}
      />;
    if ($this->:media is nonnull) {
      $ret->setAttribute('media', $this->:media);
    }
    return $ret;
  }
}
