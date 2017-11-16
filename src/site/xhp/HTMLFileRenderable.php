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

class HTMLFileRenderable implements \XHPUnsafeRenderable {
  public function __construct(
    private string $htmlFile,
    private string $htmlRoot = BuildPaths::GUIDES_HTML,
  ) {
    invariant(file_exists($htmlFile), 'html file does not exist');

    $root = realpath($htmlRoot).'/';

    invariant(
      (substr(realpath($htmlFile), 0, strlen($root)) === $root),
      'html file %s is not a build artifact',
      $htmlFile,
    );
  }

  public function toHTMLString(): string {
    return file_get_contents($this->htmlFile);
  }
}
