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

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Vec, Str};

type TIPRange = (/* bitstring */ string, /* bitmask */ string);

type TIPRanges = shape(
  'ipv4' => vec<TIPRange>,
  'ipv6' => vec<TIPRange>,
);

type TIPRangesJSON = shape(
  'ipv4' => vec<string>,
  'ipv6' => vec<string>,
);

function cidr_to_bitstring_and_bitmask(string $cidr): (string, string) {
  list($addr, $bits) = Str\split($cidr, '/');
  $bits = (int) $bits;
  $addr = \inet_pton($addr);

  $mask = Str\repeat("\xff", \intdiv($bits, 8));
  $bits = $bits % 8;
  if ($bits !== 0) {
    $mask .= \chr(((1 << $bits) - 1) << (8 - $bits));
  }
  $mask .= Str\repeat("\x00", Str\length($addr) - Str\length($mask));
  return tuple($addr, $mask);
}

function is_ip_in_range(string $ip, (string, string) $range): bool {
  $addr_bitstring = \inet_pton($ip);
  list($range_bitstring, $range_bitmask) = $range;
  /* HH_IGNORE_ERROR[4110] bitwise & on strings */
  return ($addr_bitstring & $range_bitmask) === $range_bitstring;
}

function get_fb_ip_ranges(): TIPRanges {
  return apc_fetch_or_set_function_data(
    __FUNCTION__,
    () ==> {
      $raw_data = \file_get_contents(BuildPaths::FB_IP_RANGES_JSON)
        |> JSON\decode_as_shape(TIPRangesJSON::class, $$);

      $ipv4 = Vec\map(
        $raw_data['ipv4'],
        $cidr ==> cidr_to_bitstring_and_bitmask($cidr),
      );
      $ipv6 = Vec\map(
        $raw_data['ipv6'],
        $cidr ==> cidr_to_bitstring_and_bitmask($cidr),
      );

      return shape('ipv4' => $ipv4, 'ipv6' => $ipv6);
    },
  );
}

function is_fb_ip_address(string $ip): bool {
  $ranges = get_fb_ip_ranges();
  return C\any(
    Vec\concat($ranges['ipv4'], $ranges['ipv6']),
    $range ==> is_ip_in_range($ip, $range),
  );
}
