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

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\{div, form, input, label};
use type HHVM\UserDocumentation\UIGlyphIcon;

final xhp class search_bar extends x\element {
  attribute
    string class,
    string placeholder = 'Search';

  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $class = ($this->:class !== null)
      ? "searchBar ".$this->:class
      : "searchBar";
    return
      <div class={$class}>
        <form method="get" action="/search">
          <input
            class="searchInput"
            name="term"
            type="search"
            required={true}
          />
          <div class="inputLabel">
            <ui:glyph icon={UIGlyphIcon::SEARCH} />
            <label class="searchPlaceholder">{$this->:placeholder}</label>
          </div>
        </form>
      </div>;
  }
}
