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

use namespace HH\Lib\Dict;

final class PHPDotNetAPIIndexBuildStep extends BuildStep {

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nPHPDotNetAPIIndex");

    \file_put_contents(
      BuildPaths::PHP_DOT_NET_API_INDEX_JSON,
      JSON\encode_dict($this->getIndexData()),
    );
  }


  private function getIndexData(): dict<string, PHPDotNetAPIIndexEntry> {
    $reader = new PHPDocsIndexReader(
      \file_get_contents(BuildPaths::PHP_DOT_NET_INDEX_JSON)
    );
    $defs = $reader->getAllAPIDefinitions();

    $out = dict[];
    foreach ($defs as $name => $id) {
      $type = \explode('.', $id)[0];
      $type = APIDefinitionType::coerce($type);
      if ($type === null) {
        continue;
      }

      $url = \sprintf('http://php.net/manual/en/%s.php', $id);

      $supported =
        $type === APIDefinitionType::FUNCTION_DEF
        ? \function_exists($name, /* autoload = */ false)
        : (
            \class_exists($name, /* autoload = */ false)
            || \trait_exists($name, /* autoload = */ false)
            || \interface_exists($name, /* autoload = */ false)
          );

      $out[$name] = shape(
        'type' => $type,
        'url' => $url,
        'supportedInHHVM' => $supported,
      );
    }

    return Dict\sort_by_key($out);
  }
}
