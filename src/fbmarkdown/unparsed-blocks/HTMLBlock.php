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

namespace Facebook\Markdown\UnparsedBlocks;

use type Facebook\Markdown\Blocks\HTMLBlock as ASTNode;
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\{Dict, Str};

<<__ConsistentConstruct>>
class HTMLBlock extends FencedBlock {
  const string TAG_NAME = '[a-z][a-z0-9-]*';
  const string ATTRIBUTE_NAME = '[a-z_:][a-z0-9_.:-]*';
  const string UNQUOTED_ATTRIBUTE_VALUE = '[^"\'=<>` ]+';
  const string SINGLE_QUOTED_ATTRIBUTE_VALUE = "'[^']*'";
  const string DOUBLE_QUOTED_ATTRIBUTE_VALUE = '"[^"]*"';
  const string ATTRIBUTE_VALUE =
    '('.
    self::UNQUOTED_ATTRIBUTE_VALUE.'|'.
    self::SINGLE_QUOTED_ATTRIBUTE_VALUE.'|'.
    self::DOUBLE_QUOTED_ATTRIBUTE_VALUE.
    ')';
  const string ATTRIBUTE_VALUE_SPECIFICATION = ' *= *'.self::ATTRIBUTE_VALUE;
  const string ATTRIBUTE =
  ' +'.self::ATTRIBUTE_NAME.'('.self::ATTRIBUTE_VALUE_SPECIFICATION.')?';

  const dict<string, string> PARAGRAPH_INTERRUPTING_PATTERNS = dict[
    '/^(<script|<pre|style)( |>|$)/' => ',</script>|</pre>|</style>,',
    '/^<!--/' => '/-->/',
    '/^<\\?/' => '/\\?>/',
    '/^<![A-Z]/' => '/>/',
    '/^<!\\[CDATA\\[/' => '/\\]\\]>/',
    // This very large whitelist is in the spec
    '/^<\\/?(address|article|aside|base|basefont|blockquote|body|caption|'.
      'center|col|colgroup|dd|details|dialog|dir|div|dl|dt|fieldset|'.
      'figcaption|figure|footer|form|frame|frameset|h[1-6]|head|header|hr|'.
      'html|iframe|legend|li|link|main|menu|menuitem|meta|nav|noframes|ol|'.
      'optgroup|option|p|param|section|source|summary|table|tbody|td|tfoot|th|'.
      'thead|title|tr|track|ul)( +|$|\\/)?>/' => '/^$/',
    '/^<'.self::TAG_NAME.'('.self::ATTRIBUTE.')*'.' *\\/?> *$/' => '/^$/',
  ];

  const dict<string, string> NON_INTERRUPTING_PATTERNS = dict[
    '/^<\\/'.self::TAG_NAME.' *> *$/' => '/^$/',
  ];

  public function __construct(
    private string $content,
  ) {
  }

  protected static function createFromLines(
    vec<string> $lines,
    int $_indentation_of_first,
    bool $_eof,
  ): this {
    return new static(Str\join($lines, "\n"));
  }

  <<__Override>>
  public static function consume(
    Context $context,
    Lines $lines,
  ): ?(this, Lines) {
    if (!$context->isHTMLEnabled()) {
      return null;
    }
    return parent::consume($context, $lines);
  }

  <<__Override>>
  public static function getEndPatternForFirstLine(
    Context $context,
    int $column,
    string $line,
  ): ?string {
    if ($context->isInParagraphContinuation()) {
      $patterns = self::PARAGRAPH_INTERRUPTING_PATTERNS;
    } else {
      $patterns = Dict\merge(
        self::PARAGRAPH_INTERRUPTING_PATTERNS,
        self::NON_INTERRUPTING_PATTERNS,
      );
    }

    list($line, $_) = Lines::stripUpToNLeadingWhitespace($line, 3, $column);

    foreach ($patterns as $start => $end) {
      if (\preg_match($start, $line) === 1) {
        return $end;
      }
    }
    return null;
  }

  <<__Override>>
  public function withParsedInlines(Inlines\Context $_): ASTNode {
    return new ASTNode($this->content);
  }
}
