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

  public function write(BaseYAML $def): void {
    file_put_contents(
      $this->getFileName($def),
      \Spyc::YAMLDump($def),
    );
  }

  private function getFileName(BaseYAML $def): string {
    $prefix = $def['type'];

    $def_name = strtr($def['data']['name'], "\\", '.');

    return sprintf(
      '%s/%s.%s.yml',
      $this->destination,
      $prefix,
      $def_name,
    );
  }
}
