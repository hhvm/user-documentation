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

use namespace Facebook\HackCodegen as CG;

trait CodegenBuildStep {
  protected function getCodegenFactory(): CG\HackCodegenFactory {
    $config = new CG\HackCodegenConfig();
    return new CG\HackCodegenFactory(
      $config->withFormatter(new CG\HackfmtFormatter($config)),
    );
  }
}
