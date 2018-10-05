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
namespace HHVM\UserDocumentation\Tests;

use type Facebook\HHAPIDoc\DocBlock\DocBlock;
use function Facebook\FBExpect\expect;
use namespace HH\Lib\Vec;

/**
 * @group small
 */
final class DocBlockTest extends \Facebook\HackTest\HackTest {
  private static function getDocBlock(string $method): DocBlock {
    $rm = new \ReflectionMethod(__CLASS__, $method);
    return new DocBlock((string)$rm->getDocComment());
  }

  /** Foo */
  public function testOneLiner(): void {
    expect(self::getDocBlock(__FUNCTION__)->getSummary())->toBeSame('Foo');
  }

  /** Foo. */
  public function testOneLinerWithPunctuation(): void {
    expect(self::getDocBlock(__FUNCTION__)->getSummary())->toBeSame('Foo');
  }

  /**
   * Foo
   *
   * Do bar.
   */
  public function testSummaryAndDescriptionWithoutPunctuation(): void {
    $db = self::getDocBlock(__FUNCTION__);
    expect($db->getSummary())->toBeSame('Foo');
    expect($db->getDescription())->toBeSame('Do bar.');
  }

  /**
   * Foo.
   *
   * Do bar.
   */
  public function testSummaryAndDescriptionWithPunctuation(): void {
    $db = self::getDocBlock(__FUNCTION__);
    expect($db->getSummary())->toBeSame('Foo');
    expect($db->getDescription())->toBeSame('Do bar.');
  }

  /** Foo. Do bar. */
  public function testSummaryAndDescriptionOneLiner(): void {
    $db = self::getDocBlock(__FUNCTION__);
    expect($db->getSummary())->toBeSame('Foo');
    expect($db->getDescription())->toBeSame('Do bar.');
  }

  /** Foo.
   *
   * Bar.
   *
   * @param int $everything foo bar
   * @param $no_type herp derp
   * @param $multi_line herp
   *   derp
   * @param $nothing
   * @param dict<string, string> $generics
   * @param dict<string, string> $generics_and_text foo bar
   */
  public function testHasParams(): void {
    $db = self::getDocBlock(__FUNCTION__);
    expect($db->getSummary())->toBeSame('Foo');
    expect($db->getDescription())->toBeSame('Bar.');

    $params = Vec\map(
      $db->getParameterInfo(),
      $p ==> tuple($p['name'], $p['types'], $p['text']),
    );

    expect($params)->toBeSame(
      vec[
        tuple('$everything', vec['int'], 'foo bar'),
        tuple('$no_type', vec[], 'herp derp'),
        tuple('$multi_line', vec[], "herp\nderp"),
        tuple('$nothing', vec[], null),
        tuple('$generics', vec['dict<string, string>'], null),
        tuple('$generics_and_text', vec['dict<string, string>'], 'foo bar'),
      ]
    );
  }

  /**
   * @param int|dict<string, string>|string $foo
   */
  public function testMultipleParamTypes(): void {
    $params = Vec\map(
      self::getDocBlock(__FUNCTION__)->getParameterInfo(),
      $p ==> tuple($p['name'], $p['types'], $p['text']),
    );
    expect($params)->toBeSame(vec[
      tuple('$foo', vec['int', 'dict<string, string>', 'string'], null),
    ]);
  }

  /** foo `shape(...)` bar */
  public function testEllipsisSummary(): void {
    expect(self::getDocBlock(__FUNCTION__)->getSummary())
      ->toBeSame('foo `shape(...)` bar');
  }
}
