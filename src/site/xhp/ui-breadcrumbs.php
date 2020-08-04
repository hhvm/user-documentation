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

namespace HHVM\UserDocumentation\ui;

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{a, div, i};
use namespace HH\Lib\{C, Vec};

final xhp class breadcrumbs extends x\element {
  attribute vec<(string, ?string)> stack @required;

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $stack = $this->:stack;
    list($current, $_) = C\lastx($stack);
    $ancestors = Vec\take($stack, C\count($stack) - 1);

    $container = (
      <x:frag>
        <a href="/">Documentation</a>
      </x:frag>
    );
    foreach ($ancestors as list($name, $url)) {
      $link = $url === null ? $name : <a href={$url}>{$name}</a>;
      $container->appendChild(
        <x:frag>
          <i class="breadcrumbSeparator" />
          {$link}
        </x:frag>,
      );
    }
    $container->appendChild(
      <x:frag>
        <i class="breadcrumbSeparator" />
        {$current}
      </x:frag>,
    );
    return (
      <div class="breadcrumbNav">
        <div class="widthWrapper">
          {$container}
        </div>
      </div>
    );
  }
}
