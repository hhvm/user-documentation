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

class YAMLWriter {
  public function __construct(
    private string $destination,
  ) {
  }

  public function write<T as BaseYAML>(typename<T> $type, T $def): string {
    invariant(
      $type !== BaseYAML::class,
      'Must specify a subtype of BaseYAML',
    );
    $file = $this->getFileName($def);
    \file_put_contents($file, JSON\encode_shape($type, $def));
    return $file;
  }

  private function getFileName(BaseYAML $def): string {
    $prefix = $def['type'];

    $def_name = \strtr($def['data']['name'], "\\", '.');

    return \sprintf(
      '%s/%s.%s.yml',
      $this->destination,
      $prefix,
      $def_name,
    );
  }
}
