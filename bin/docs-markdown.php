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

namespace HHVM\UserDocumentation;

require_once(__DIR__.'/../vendor/hh_autoload.php');

function cli_markdown_render(string $file): string {
  return (new MarkdownRenderer())->renderMarkdownToHTML($file, \file_get_contents($file));
}

$file = $argv[1] ?? '/dev/stdin';

print(cli_markdown_render($file));
