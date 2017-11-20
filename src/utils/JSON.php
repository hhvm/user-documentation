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

namespace HHVM\UserDocumentation\JSON;

use namespace Facebook\TypeAssert;

function decode_as_dict(string $json): dict<string, mixed> {
  return \json_decode(
    $json,
    /* assoc = */ true,
    /* depth = */ 512,
    JSON_FB_HACK_ARRAYS,
  );
}

function decode_as_shape<T as shape(...)>(typename<T> $type, string $json): T {
  return TypeAssert\matches_type_structure(
    \HHVM\UserDocumentation\type_alias_structure($type),
    \json_decode(
      $json,
      /* assoc = */ true,
      /* depth = */ 512,
    ),
  );
}

function encode_dict<Tk as arraykey, Tv>(dict<Tk, Tv> $data): string {
  return json_encode(
    $data,
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
    /* depth = */ 512,
  );
}

function encode_shape<T as shape(...)>(
  typename<T> $type,
  shape(...) $data,
): string {
  return json_encode(
    TypeAssert\matches_type_structure(
      \HHVM\UserDocumentation\type_alias_structure($type),
      $data,
    ),
    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
    /* depth = */ 512,
  );
}
