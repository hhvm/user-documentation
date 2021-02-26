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

use type Facebook\AutoloadMap\{IncludedRoots, RootImporter, Writer};

/** Update the HHVM autoload map.
 *
 * As we codegen Hack classes, we want a new autoload map with the generated
 * classes.
 */
final class UpdateAutoloaderBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    Log::i("UpdateAutoloaderBuildStep\n");
    self::generateAutoloadMap();
  }

  public static function generateAutoloadMap(): void {
    $dev = \Facebook\AutoloadMap\Generated\is_dev();
    $importer = new RootImporter(
      LocalConfig::ROOT,
      $dev ? IncludedRoots::DEV_AND_PROD : IncludedRoots::PROD_ONLY,
    );

    $config = $importer->getConfig();
    $handler = $dev
      ? ($config['devFailureHandler'] ?? null)
      : ($config['failureHandler'] ?? null);

    (new Writer())
      ->setBuilder($importer)
      ->setRoot(LocalConfig::ROOT)
      ->setRelativeAutoloadRoot($config['relativeAutoloadRoot'])
      ->setFailureHandler(
        /* HH_IGNORE_ERROR[4110] silent upcast from string to failure handler*/ $handler,
      )
      ->setIsDev($dev)
      ->writeToDirectory(LocalConfig::ROOT.'/vendor/');
  }
}
