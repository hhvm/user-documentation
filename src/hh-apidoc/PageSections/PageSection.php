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
  DocBlock\DocBlock,
  Documentable,
  MarkdownBuilderContext,
};
use type Facebook\DefinitionFinder\{ScannedClassish, ScannedDefinition};

<<__ConsistentConstruct>>
abstract class PageSection {
  protected ScannedDefinition $definition;
  protected ?ScannedClassish $parent;

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
