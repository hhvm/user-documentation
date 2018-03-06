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

namespace Facebook\HHAPIDoc;

use namespace HH\Lib\{Str, Vec};

class MarkdownBuilder {
  public function __construct(
    private MarkdownBuilderContext $context,
  ) {
  }

  protected function getPageSections(
  ): keyset<classname<PageSections\PageSection>> {
    return keyset[
      PageSections\NameHeading::class,
      PageSections\DeprecationMessage::class,
      PageSections\Summary::class,
      PageSections\FunctionishSignature::class,
      PageSections\Description::class,
      PageSections\InterfaceSynopsis::class,
      PageSections\FunctionishParameters::class,
      PageSections\FunctionishReturnValues::class,
    ];
  }

  public function getDocumentation(
    Documentable $documentable,
  ): string {
    $docs = DocBlock\DocBlock::nullable(
      $documentable['definition']->getDocComment(),
    );
    $ctx = $this->context;
    return $this->getPageSections()
      |> Vec\map($$, $s ==> (new $s($ctx, $documentable, $docs))->getMarkdown())
      |> Vec\filter_nulls($$)
      |> Str\join($$, "\n\n");
  }
}
