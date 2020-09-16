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
 * These flags can be specified in an extractable code block's info string, e.g.
 * ```filename.hack no-auto-output
 */
enum Flags: string as string {
  NO_AUTO_OUTPUT = 'no-auto-output';
}
