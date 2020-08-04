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

use namespace Facebook\XHP;

class HTMLFileRenderable implements XHP\UnsafeRenderable {
  public function __construct(
    private string $htmlFile,
    private string $htmlRoot = BuildPaths::GUIDES_HTML,
  ) {
    invariant(\file_exists($htmlFile), 'html file does not exist');

    $root = \realpath($htmlRoot).'/';

    invariant(
      (\substr(\realpath($htmlFile), 0, \strlen($root)) === $root),
      'html file %s is not a build artifact',
      $htmlFile,
    );
  }

  public async function toHTMLStringAsync(): Awaitable<string> {
    return \file_get_contents($this->htmlFile);
  }
}
