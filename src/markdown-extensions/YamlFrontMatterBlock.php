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
use namespace Facebook\Markdown\UnparsedBlocks;
use namespace HHVM\UserDocumentation\JSON;
use namespace HH\Lib\{C, Dict, Str, Vec};

abstract class YamlFrontMatterBlock implements UnparsedBlocks\BlockProducer {
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
      $context is BlockContext,
      'Expected context to be a %s',
      BlockContext::class,
    );

    $data = JSON\decode_as_shape(YAMLMeta::class, $block->getContent());
    $context->setYamlMeta($data);

    $messages = Vec\filter_nulls(vec[
      self::getVersionRequirementMessage($data),
      self::getLibMessage($data),
      self::getFacebookMessages($data),
      self::getTipMessages($data),
      self::getWarningMessages($data),
      self::getDangerMessages($data),
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

  private static function getVersionRequirementMessage(
    YAMLMeta $data,
  ): ?UnparsedBlocks\Block {
    $versions = $data['min-versions'] ?? null;
    if ($versions === null) {
      return null;
    }
    $experimental = null;
    if ($data['experimental'] ?? false) {
      $experimental = ', and is currently experimental';
    }

    return UnparsedBlocks\BlockSequence::flatten(
      new UnparsedBlocks\HTMLBlock('<div class="apiTopMessage apiFromLib">'),
      new UnparsedBlocks\InlineSequenceBlock(
        'This functionality requires '.
        (
          $versions
          |> Dict\map_with_key(
            $$,
            ($name, $ver) ==> \sprintf('%s %s or later', $name, $ver),
          )
          |> Str\join($$, ', ')
        ).
        $experimental.
        '.',
      ),
      new UnparsedBlocks\HTMLBlock('</div>'),
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
      'Requires '.
      '<a href="https://github.com/'.
      $lib['github'].
      '/">'.
      $lib['name'].
      '</a> to be installed.'.
      '</div>',
    );
  }

  private static function getFacebookMessages(
    YAMLMeta $data,
  ): ?UnparsedBlocks\Block {
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
        '<p>'.
        $message.
        "</p>\n".
        '<!-- '.
        'Not a Facebook engineer... yet? https://www.facebook.com/careers/'.
        " -->\n".
        '</div>',
      ),
    );
    return new UnparsedBlocks\BlockSequence($messages);
  }

  private static function getTipMessages(
    YAMLMeta $data,
  ): ?UnparsedBlocks\Block {
    $tip_messages = $data['tip'] ?? null;
    if ($tip_messages === null) {
      return null;
    }

    $tip_messages = Vec\map(
      $tip_messages,
      $tip_message ==> new UnparsedBlocks\InlineSequenceBlock(
        '<div class="tipMessage">'.
        "**Tip:**\n\n".
        $tip_message.
        '</div>',
      ),
    );
    return new UnparsedBlocks\BlockSequence($tip_messages);
  }

  private static function getWarningMessages(
    YAMLMeta $data,
  ): ?UnparsedBlocks\Block {
    $warning_messages = $data['warning'] ?? null;
    if ($warning_messages === null) {
      return null;
    }

    $warning_messages = Vec\map(
      $warning_messages,
      $warning_message ==> new UnparsedBlocks\InlineSequenceBlock(
        '<div class="warningMessage">'.
        "**Warning:**\n\n".
        $warning_message.
        '</div>',
      ),
    );
    return new UnparsedBlocks\BlockSequence($warning_messages);
  }

  private static function getDangerMessages(
    YAMLMeta $data,
  ): ?UnparsedBlocks\Block {
    $danger_messages = $data['danger'] ?? null;
    if ($danger_messages === null) {
      return null;
    }

    $danger_messages = Vec\map(
      $danger_messages,
      $danger_message ==> new UnparsedBlocks\InlineSequenceBlock(
        '<div class="dangerMessage">'.
        "**Danger:**\n\n".
        $danger_message.
        '</div>',
      ),
    );
    return new UnparsedBlocks\BlockSequence($danger_messages);
  }
}
