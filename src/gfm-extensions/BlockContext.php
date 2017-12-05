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

namespace HHVM\UserDocumentation\GFM;

use type HHVM\UserDocumentation\YAMLMeta;
use namespace Facebook\GFM\UnparsedBlocks;

final class BlockContext extends UnparsedBlocks\Context {
  private ?YAMLMeta $yamlMeta = null;

  public function setYamlMeta(YAMLMeta $meta): this {
    $this->yamlMeta = $meta;
    return $this;
  }

  public function getYamlMeta(): ?YAMLMeta {
    return $this->yamlMeta;
  }

  <<__Override>>
  public function resetFileData(): this {
    $this->yamlMeta = null;
    return parent::resetFileData();
  }
}
