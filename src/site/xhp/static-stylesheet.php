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

use HHVM\UserDocumentation\StaticResourceMap;

final class :static:stylesheet extends :static:base {
  use XHPHelpers;

  attribute :link;

  protected function getAllowedMimeTypes(): Set<string> {
    return Set { 'text/css' };
  }

  protected function render(): XHPRoot {
    return
      <link
        rel="stylesheet"
        type={$this->getMimeType()}
        href={$this->getVersionedURL()}
      />;
  }
}
