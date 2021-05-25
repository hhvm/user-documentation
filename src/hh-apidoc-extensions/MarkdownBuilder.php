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
use namespace HH\Lib\{C, Keyset, Vec};

final class MarkdownBuilder extends HHAPIDoc\DocumentationBuilder {
  <<__Override>>
  protected function getPageSections(
  ): keyset<classname<HHAPIDoc\PageSections\PageSection>> {
    $inherited = Keyset\filter(
      parent::getPageSections(),
      $section ==>
        $section !== HHAPIDoc\PageSections\NameHeading::class &&
        // InterfaceSynopsis moved to the bottom (see below)
        $section !== HHAPIDoc\PageSections\InterfaceSynopsis::class,
    );
    $sections = Vec\concat(
      vec[
        PageSections\FrontMatter::class,
      ],
      $inherited,
      vec[
        PageSections\Examples::class,
        HHAPIDoc\PageSections\InterfaceSynopsis::class,
      ],
    );
    // Insert "Guides" after description.
    $desc_key = C\find_key(
      $sections,
      $s ==> $s === HHAPIDoc\PageSections\Description::class,
    ) as nonnull;
    return Keyset\union(
      Vec\take($sections, $desc_key + 1),
      vec[PageSections\Guides::class],
      Vec\slice($sections, $desc_key + 1),
    );
  }
}
