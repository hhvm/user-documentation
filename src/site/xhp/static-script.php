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

namespace HHVM\UserDocumentation\static;

use namespace Facebook\XHP\{Core as x, HTML};

final xhp class script extends base {
  <<__Override>>
  protected function getAllowedMimeTypes(): Set<string> {
    return Set {'application/javascript'};
  }

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    return
      <HTML:script type={$this->getMimeType()} src={$this->getVersionedURL()} />;
  }
}
