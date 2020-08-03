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

final xhp class static:script extends :static:base {
  protected function getAllowedMimeTypes(): Set<string> {
    return Set {'application/javascript'};
  }

  protected function render(): XHPRoot {
    return
      <script type={$this->getMimeType()} src={$this->getVersionedURL()} />;
  }
}
