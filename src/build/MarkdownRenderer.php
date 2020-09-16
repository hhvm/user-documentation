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

use namespace HH\Lib\C;
use namespace Facebook\Markdown;

final class MarkdownRenderer {
  <<__Memoize>>
  private function getParserContext(): Markdown\ParserContext {
    $parser_ctx = (new Markdown\ParserContext())
      ->setBlockContext(
        (new MarkdownExt\BlockContext())
          ->prependBlockTypes(
            MarkdownExt\YamlFrontMatterBlock::class,
            MarkdownExt\ExamplesIncludeBlock::class,
            MarkdownExt\IncludeGeneratedMarkdownBlock::class,
          ),
      )
      ->enableHTML_UNSAFE();
    $parser_ctx->getInlineContext()
      ->prependInlineTypes(MarkdownExt\AutoLinkifyInline::class);
    return $parser_ctx;
  }

  <<__Memoize>>
  private function getRenderContext(
    bool $is_automated_build,
  ): MarkdownExt\RenderContext {
    $render_ctx = (new MarkdownExt\RenderContext())
      ->appendFilters(
        new MarkdownExt\HeadingAnchorsFilter(),
        new MarkdownExt\VersionedImagesFilter(),
        new MarkdownExt\InternalMarkdownLinksFilter(),
        $is_automated_build
          ? new MarkdownExt\ExtractedCodeBlocks\VerifyFilter()
          : new MarkdownExt\ExtractedCodeBlocks\ExtractFilter(),
        new MarkdownExt\PrettyCodeBlocksFilter(),
      );
    return $render_ctx;
  }

  public function renderMarkdownToHTML(
    string $file,
    string $markdown,
    keyset<BuildFlags> $build_flags,
  ): string {
    $parser_ctx = $this->getParserContext()
      ->resetFileData()
      ->setFilePath($file);
    $render_ctx = $this
      ->getRenderContext(C\contains_key($build_flags, BuildFlags::AUTOMATED))
      ->resetFileData()
      ->setFilePath($file);

    $doc = Markdown\parse($parser_ctx, $markdown);
    return (new MarkdownExt\HTMLRenderer($render_ctx))->render($doc);
  }
}
