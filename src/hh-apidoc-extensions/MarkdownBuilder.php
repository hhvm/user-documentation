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

namespace HHVM\UserDocumentation\HHAPIDocExt;

use namespace Facebook\HHAPIDoc;
use namespace HH\Lib\Keyset;

final class MarkdownBuilder extends HHAPIDoc\MarkdownBuilder {
  protected function getPageSections(
  ): keyset<classname<HHAPIDoc\PageSections\PageSection>> {
    $inherited = Keyset\filter(
      parent::getPageSections(),
      $section ==> $section !== HHAPIDoc\PageSections\NameHeading::class,
    );
    return Keyset\union(
      keyset[
        PageSections\FrontMatter::class,
      ],
      $inherited,
      keyset[
        PageSections\Examples::class,
      ],
    );
  }
}
