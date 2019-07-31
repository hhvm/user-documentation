/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation\Util;

use namespace HH\Lib\Str;

enum TarEntryType: int {
  FILE = 0;
  SYMLINK = 1;
  DIRECTORY = 2;
}

type TarEntryMetadata = shape(
  'type' => TarEntryType,
  'mode' => int,
  'timestamp' => int,
  'path' => string,
);

/** Parse a tar file, executing a callback for every thing inside it.
 *
 * This function is derived from HHVM 3's Phar handling, which is no longer
 * present.
 */
function parse_tar(
  string $tar,
  (function(TarEntryMetadata, ?string): void) $callback,
): void {
  $len = Str\length($tar);
  $pos = new \HH\Lib\Ref(0);
  $consume = (int $bytes) ==> {
    $wanted = Str\slice($tar, $pos->value, $bytes);
    $pos->value += $bytes;
    return $wanted;
  };
  /* If you have GNU Tar installed, you should be able to find
   * the file format documentation (including header byte offsets) at:
   * - /usr/include/tar.h
   * - the tar info page (Top/Tar Internals/Standard)
   */

  $next_file_name = null;
  $mode = null;
  while ($pos->value < $len) {
    $header = $consume(512);
    // skip empty blocks
    if (!\trim($header)) {
      continue;
    }

    $filename = \trim(\substr($header, 0, 100));
    if ($next_file_name) {
      $filename = $next_file_name;
      $next_file_name = null;
    }

    $mode = \octdec(\substr($header, 100, 7));
    $size = \octdec(\substr($header, 124, 12));
    $timestamp = \octdec(\trim(\substr($header, 136, 12)));
    $type = $header[156];

    $entry_type = null;
    $entry_content = null;

    switch ($type) {
      case 'L':
        invariant(
          $filename === '././@LongLink',
          "Expected magic filename '././@LongLink' for long file ".
          "name, got %s instead",
          $filename,
        );
        $next_file_name = \trim($consume($size));
        break;

      case '0':
      case "\0":
        $entry_type = TarEntryType::FILE;
        $entry_content = $consume($size);
        break;

      case '2':
        // Assuming this is from GNU Tar
        $target = \trim(\substr($header, 157, 100), "\0");

        $entry_type = TarEntryType::SYMLINK;
        $entry_content = $target;
        break;
      case '5':
        $entry_type = TarEntryType::DIRECTORY;
        break;
      case 'g':
        // Global header of the form "BYTECOUNT key=value"; github sends us
        // tarballs with comment=COMMIT_HASH; just ignore it.
        $consume($size);
        break;
      case 'x':
        // Extended header, see https://tinyurl.com/pax-extended-header.
        list($_, $extended_header_content) = Str\split($consume($size), ' ', 2);
        list($key, $value) = Str\split($extended_header_content, '=', 2);
        $value = Str\trim_right($value, "\n");
        switch ($key) {
          case 'path':
            $next_file_name = $value;
            break;
          default:
            throw
              new \Exception("Tar extended header '$key' is not implemented");
        }
        break;
      default:
        throw new \Exception("Tar entry type '$type' is not implemented");
    }

    if ($entry_type !== null) {
      $callback(
        shape(
          'type' => $entry_type,
          'mode' =>
            $mode ?? ($entry_type === TarEntryType::DIRECTORY ? 0755 : 0644),
          'timestamp' => $timestamp,
          'path' => $filename,
        ),
        $entry_content,
      );
    }
    if ($size % 512 !== 0) {
      $leftover = 512 - ($size % 512);
      $zeroes = $consume($leftover);
      if (\strlen(\trim($zeroes)) !== 0) {
        throw new \Exception("Malformed tar. Padding isn't zeros. $zeroes");
      }
    }
  }
}
