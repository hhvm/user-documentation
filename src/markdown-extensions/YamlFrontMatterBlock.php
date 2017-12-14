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

namespace HHVM\UserDocumentation\MarkdownExt;

use type HHVM\UserDocumentation\YAMLMeta;
use namespace Facebook\Markdown\{Inlines, UnparsedBlocks};
use namespace HHVM\UserDocumentation\JSON;
use namespace HH\Lib\{C, Str, Vec};

abstract class YamlFrontMatterBlock extends UnparsedBlocks\Block{
  <<__Override>>
  public static function consume(
    UnparsedBlocks\Context $context,
    UnparsedBlocks\Lines $lines,
  ): ?(UnparsedBlocks\Block, UnparsedBlocks\Lines) {
    $match = UnparsedBlocks\FencedCodeBlock::consume($context, $lines);
    if ($match === null) {
      return null;
    }
    list($block, $rest) = $match;
    if ($block->getInfoString() !== 'yamlmeta') {
      return null;
    }

    invariant(
      $context instanceof BlockContext,
      'Expected context to be a %s',
      BlockContext::class,
    );

    $data = JSON\decode_as_shape(
      YAMLMeta::class,
      $block->getContent(),
    );
    $context->setYamlMeta($data);

    $messages = Vec\filter_nulls(vec[
      self::getLibMessage($data),
      self::getFacebookMessages($data),
    ]);

    if (C\is_empty($messages)) {
      return tuple(new UnparsedBlocks\BlockSequence(vec[]), $rest);
    }
    $messages = new UnparsedBlocks\BlockSequence($messages);

    return tuple(
      UnparsedBlocks\BlockSequence::flatten(
        new UnparsedBlocks\HTMLBlock('<div class="apiTopMessages">'),
        $messages,
        new UnparsedBlocks\HTMLBlock('</div>'),
      ),
      $rest,
    );
  }

  private static function getLibMessage(YAMLMeta $data): ?UnparsedBlocks\Block {
    $lib = $data['lib'] ?? null;
    if ($lib === null) {
      return null;
    }

    // TODO: fix XHP in namespaces
    return new UnparsedBlocks\HTMLBlock(
      '<div class="apiTopMessage apiFromLib">'.
        'This API is part of '.
        '<a href="https://github.com/'.$lib['github'].'/">'.
        $lib['name'].
        '</a>, not HHVM itself.'.
      '</div>',
    );
  }

  private static function getFacebookMessages(YAMLMeta $data): ?UnparsedBlocks\Block {
    $messages = $data['fbonly messages'] ?? null;
    if ($messages === null) {
      return null;
    }

    // TODO: fix XHP in namespaces
    $messages = Vec\map(
      $messages,
      $message ==> new UnparsedBlocks\InlineSequenceBlock(
        '<div class="apiTopMessage fbOnly">'.
        "**Facebook Engineer?**\n\n".
        '<p>'.$message."</p>\n".
        '<!-- '.
        'Not a Facebook engineer... yet? https://www.facebook.com/careers/'.
        " -->\n".
        '</div>',
      ),
    );
    return new UnparsedBlocks\BlockSequence($messages);
  }
}
