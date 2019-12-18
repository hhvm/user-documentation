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

namespace HHVM\UserDocumentation\MarkdownExt;

use namespace HH\Lib\Keyset;

final class RenderContext extends \Facebook\HHAPIDoc\MarkdownExt\RenderContext {
  <<__Override>>
  public function getImplicitPrefixes(): keyset<string> {
    return Keyset\union(
      parent::getImplicitPrefixes(),
      keyset["HH\Lib\\Experimental\\"],
    );
  }
}
