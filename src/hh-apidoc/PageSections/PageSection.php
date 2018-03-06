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

namespace Facebook\HHAPIDoc\PageSections;

use type Facebook\HHAPIDoc\{
  Documentable,
  DocBlock\DocBlock,
  MarkdownBuilderContext,
};
use type Facebook\DefinitionFinder\{
  ScannedBase,
  ScannedClass,
};

<<__ConsistentConstruct>>
abstract class PageSection {
  protected ScannedBase $definition;
  protected ?ScannedClass $parent;

  public function __construct(
    protected MarkdownBuilderContext $context,
    protected Documentable $documentable,
    protected ?DocBlock $docBlock,
  ) {
    $this->definition = $documentable['definition'];
    $this->parent = $documentable['parent'];
  }

  abstract public function getMarkdown(): ?string;
}
