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

final class :ui:breadcrumbs extends :x:element {
  attribute
    ConstMap<string, string> parents @required,
    string currentPage @required;

  public function render(): XHPRoot{
    $container = (
      <x:frag>
        <a href="/">Documentation</a>
      </x:frag>
    );
    foreach ($this->:parents as $name => $url) {
      $container->appendChild(
        <x:frag>
          <i class="breadcrumbSeparator" />
          <a href={$url}>{$name}</a>
        </x:frag>
      );
    }
    $container->appendChild(
      <x:frag>
        <i class="breadcrumbSeparator" />
        {$this->:currentPage}
      </x:frag>
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
