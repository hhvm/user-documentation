<?hh
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks;

/**
 * These extra files can be explicitly specified in extractable code blocks
 * and/or auto-generated from extractable code blocks that don't specify them.
 * The enum values are suffixes appended to the original file name.
 */
enum Files: string as string {
  HHCONFIG = 'hhconfig';
  INI = 'ini';
  HHVM_EXPECT = 'hhvm.expect';
  HHVM_EXPECTF = 'hhvm.expectf';
  HHVM_EXPECTREGEX = 'expectregex';
  EXAMPLE_HHVM_OUT = 'example.hhvm.out';
  TYPECHECKER_EXPECT = 'typechecker.expect';
  TYPECHECKER_EXPECTF = 'typechecker.expectf';
  TYPECHECKER_EXPECTREGEX = 'typechecker.expectregex';
  EXAMPLE_TYPECHECKER_OUT = 'example.typechecker.out';
  SKIPIF = 'skipif';
}
