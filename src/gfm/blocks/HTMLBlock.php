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

namespace Facebook\GFM\Blocks;

final class HTMLBlock extends FencedBlock {
  const string TAG_NAME = '[a-z][a-z0-9-]*';
  const string ATTRIBUTE_NAME = '[a-z_:][a-z0-9_.:-]*';
  const string UNQUOTED_ATTRIBUTE_VALUE = '[^"\'=<>` ]+';
  const string SINGLE_QUOTED_ATTRIBUTE_VALUE = "'[^']*'";
  const string DOUBLE_QUOTED_ATTRIBUTE_VALUE = '"[^"]*"';
  const string ATTRIBUTE_VALUE =
    self::UNQUOTED_ATTRIBUTE_VALUE.'|'.
    self::SINGLE_QUOTED_ATTRIBUTE_VALUE.'|'.
    self::DOUBLE_QUOTED_ATTRIBUTE_VALUE;
  const string ATTRIBUTE_VALUE_SPECIFICATION = ' *= *'.self::ATTRIBUTE_VALUE;
  const string ATTRIBUTE =
  ' +'.self::ATTRIBUTE_NAME.'('.self::ATTRIBUTE_VALUE_SPECIFICATION.')?';

  const dict<string, string> PATTERNS = dict[
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
    '/^<\\/'.self::TAG_NAME.' *> *$/' => '/^$/',
  ];

  <<__Override>>
  public static function getEndPatternForFirstLine(string $line): ?string {
    foreach (self::PATTERNS as $start => $end) {
      if (\preg_match($start, $line) === 1) {
        return $end;
      }
    }
    return null;
  }
}
