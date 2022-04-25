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

use namespace HH\Lib\Str;

final class MetaIPRangesBuildStep extends BuildStep {

  <<__Override>>
  public function buildAll(): void {
    if (Str\ends_with(\php_uname('n'), '.facebook.com')) {
      Log::v("\nMetaONLY: Creating empty list of Meta employee IP addresses...");
      \file_put_contents(BuildPaths::META_IP_RANGES_JSON, \json_encode(
        shape('ipv4' => vec[], 'ipv6' => vec[]),
        \JSON_PRETTY_PRINT,
      ));
      return;
    }

    Log::v("\nCreating list of Meta employee IP addresses...");

    $errno = null;
    $errstr = null;
    $handle = \stream_socket_client(
      'tcp://whois.radb.net:43',
      inout $errno,
      inout $errstr,
    );
    if ($handle === false) {
      \fprintf(
        \STDERR,
        "Failed to open whois connection: %d: %s\n",
        $errno,
        $errstr,
      );
      exit(1);
    }

    // Persistent connection
    \fwrite($handle, "!!\n");

    \fwrite($handle, "!gas54115\n");
    $ipv4 = self::readRadbRanges($handle);
    \fwrite($handle, "!6as54115\n");
    $ipv6 = self::readRadbRanges($handle);
    \fclose($handle);

    \file_put_contents(
      BuildPaths::META_IP_RANGES_JSON,
      \json_encode(shape('ipv4' => $ipv4, 'ipv6' => $ipv6), \JSON_PRETTY_PRINT),
    );
  }

  private static function readRadbRanges(resource $handle): vec<string> {
    // Alength\nCONTENT\nC
    $first = \fgets($handle);
    invariant(Str\starts_with($first, 'A'), 'Expected ^A\d+$, got %s', $first);
    $length = (int)Str\strip_prefix(Str\trim_right($first), 'A');
    $data = \fread($handle, $length);
    $rest = \fgets($handle);
    invariant(Str\trim($rest) === 'C', 'Expected just "C", got %s', $rest);

    return $data |> Str\trim($$) |> Str\split($$, ' ');
  }
}
