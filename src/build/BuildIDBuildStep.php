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

final class BuildIDBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nBuildID");
    $docsite_rev_file = __DIR__.'/../../DOCSITE_REV';
    if (file_exists($docsite_rev_file)) {
      $docsite_rev = trim(file_get_contents($docsite_rev_file));
    } else {
      $docsite_rev = $this->getHead(__DIR__.'/../../');
    }

    $build_id = strftime('%FT%T%z').':'.$docsite_rev;
    file_put_contents(BuildPaths::BUILD_ID_FILE, $build_id."\n");
  }

  private function getHead(string $path): string {
    $rev = shell_exec(
      sprintf(
        "GIT_DIR=%s git rev-parse HEAD",
        escapeshellarg($path.'/.git'),
      )
    );
    return trim($rev);
  }
}
