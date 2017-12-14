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

namespace Facebook\Markdown;

use namespace HH\Lib\{C, Str, Vec};

abstract class Renderer<T> {
  public function __construct(
    private RenderContext $context,
  ) {
  }

  protected function getContext(): RenderContext {
    return $this->context;
  }

  final public function render(ASTNode $node): T {
    $nodes = $this->getContext()->transformNode($node);
    if (C\count($nodes) === 1) {
      return $this->renderResolvedNode(C\onlyx($nodes));
    }
    return $this->renderNodes($nodes);
  }

  abstract protected function renderNodes(vec<ASTNode> $nodes): T;

  ///// blocks /////

  abstract protected function renderBlankLine(): T;
  abstract protected function renderBlockQuote(Blocks\BlockQuote $node): T;
  abstract protected function renderCodeBlock(Blocks\CodeBlock $node): T;
  protected function renderDocument(Blocks\Document $node): T {
    return $this->renderNodes($node->getChildren());
  }
  abstract protected function renderHeading(Blocks\Heading $node): T;
  abstract protected function renderHTMLBlock(Blocks\HTMLBlock $node): T;
  abstract protected function renderLinkReferenceDefinition(
    Blocks\LinkReferenceDefinition $node
  ): T;
  abstract protected function renderListOfItems(Blocks\ListOfItems $node): T;
  abstract protected function renderParagraph(Blocks\Paragraph $node): T;
  abstract protected function renderTableExtension(Blocks\TableExtension $node): T;
  abstract protected function renderThematicBreak(): T;

  ///// inlines ////

  abstract protected function renderAutoLink(Inlines\AutoLink $node): T;
  abstract protected function renderCodeSpan(Inlines\CodeSpan $node): T;
  abstract protected function renderEmphasis(Inlines\Emphasis $node): T;
  abstract protected function renderHardLineBreak(): T;
  abstract protected function renderImage(Inlines\Image $node): T;
  abstract protected function renderInlineWithPlainTextContent(
    Inlines\InlineWithPlainTextContent $node,
  ): T;
  abstract protected function renderLink(Inlines\Link $node): T;
  abstract protected function renderRawHTML(Inlines\RawHTML $node): T;
  abstract protected function renderSoftLineBreak(): T;
  abstract protected function renderStrikethroughExtension(
    Inlines\StrikethroughExtension $node,
  ): T;

  protected function renderResolvedNode(
    ASTNode $node,
  ): T {
    if ($node instanceof Blocks\BlankLine) {
      return $this->renderBlankLine();
    }

    if ($node instanceof Blocks\BlockQuote) {
      return $this->renderBlockQuote($node);
    }

    if ($node instanceof Blocks\BlockSequence) {
      return $this->renderNodes($node->getChildren());
    }

    if ($node instanceof Blocks\Document) {
      return $this->renderDocument($node);
    }

    // Blocks\FencedCodeBlock
    // Blocks\IndentedCodeBlock
    if ($node instanceof Blocks\CodeBlock) {
      return $this->renderCodeBlock($node);
    }

    if ($node instanceof Blocks\Heading) {
      return $this->renderHeading($node);
    }

    if ($node instanceof Blocks\HTMLBlock) {
      return $this->renderHTMLBlock($node);
    }

    if ($node instanceof Blocks\InlineSequenceBlock) {
      return $this->renderNodes($node->getChildren());
    }

    if ($node instanceof Blocks\LinkReferenceDefinition) {
      return $this->renderLinkReferenceDefinition($node);
    }

    if ($node instanceof Blocks\ListOfItems) {
      return $this->renderListOfItems($node);
    }

    if ($node instanceof Blocks\Paragraph) {
      return $this->renderParagraph($node);
    }

    if ($node instanceof Blocks\TableExtension) {
      return $this->renderTableExtension($node);
    }

    if ($node instanceof Blocks\ThematicBreak) {
      return $this->renderThematicBreak();
    }

    if ($node instanceof Inlines\AutoLink) {
      return $this->renderAutoLink($node);
    }

    // Inlines\BackslashEscape
    // Inlines\DisallowedRawHTML
    // Inlines\EntityReference
    // Inlines\TextualContent
    if ($node instanceof Inlines\InlineWithPlainTextContent) {
      return $this->renderInlineWithPlainTextContent($node);
    }

    if ($node instanceof Inlines\CodeSpan) {
      return $this->renderCodeSpan($node);
    }

    if ($node instanceof Inlines\Emphasis) {
      return $this->renderEmphasis($node);
    }

    if ($node instanceof Inlines\HardLineBreak) {
      return $this->renderHardLineBreak();
    }

    if ($node instanceof Inlines\Image) {
      return $this->renderImage($node);
    }

    if ($node instanceof Inlines\InlineSequence) {
      return $this->renderNodes($node->getChildren());
    }

    if ($node instanceof Inlines\Link) {
      return $this->renderLink($node);
    }

    if ($node instanceof Inlines\RawHTML) {
      return $this->renderRawHTML($node);
    }

    if ($node instanceof Inlines\SoftLineBreak) {
      return $this->renderSoftLineBreak();
    }

    if ($node instanceof Inlines\StrikethroughExtension) {
      return $this->renderStrikethroughExtension($node);
    }

    invariant_violation(
      "Unhandled node type: %s",
      get_class($node),
    );
  }
}
