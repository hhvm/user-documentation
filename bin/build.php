<?hh // partial
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

require(__DIR__.'/../vendor/hh_autoload.php');

use namespace HH\Lib\Vec;

function build_site(?Traversable<string> $filters = null): void {
  if (!\is_dir(BuildPaths::SCRATCH_DIR)) {
    \mkdir(BuildPaths::SCRATCH_DIR, 0755, /* recursive = */ true);
  }
  if (!\is_dir(BuildPaths::FINAL_DIR)) {
    \mkdir(BuildPaths::FINAL_DIR, 0755, /* recursive = */ true);
  }

  $steps = vec[
    // No Dependencies
    HHAPIDocBuildStep::class,
    PHPIniSupportInHHVMBuildStep::class,
    FacebookIPRangesBuildStep::class,

    // Needs getting the PHP ini settings HHVM supports
    PHPIniSupportInHHVMMarkdownBuildStep::class,

    // Needs the YAML
    GuidesIndexBuildStep::class,

    // Needs the previous indices
    UnifiedAPIIndexBuildStep::class,
    SiteMapBuildStep::class,
    APILegacyRedirectsBuildStep::class,

    // This needs to be able to invoke static methods on the controllers;
    // some of the controller files require_once() generated indicies, so the
    // indices must be built before codegen can be updated.
    RoutingCodegenBuildStep::class,

    // Static Resources
    SASSBuildStep::class,
    StaticResourceMapBuildStep::class,

    // Needs the Markdown
    GuidesHTMLBuildStep::class,
    APIHTMLBuildStep::class,

    // Needs to be done after all Hack codegen
    UpdateAutoloaderBuildStep::class,
  ];

  if ($filters !== null) {
    $steps = Vec\filter(
      $steps,
      $step ==> {
        foreach ($filters as $filter) {
          if (\stripos($step, $filter) !== false) {
            return true;
          }
        }
        return false;
      }
    );
  }

  $steps = Vec\concat(vec[BuildIDBuildStep::class], $steps);

  foreach ($steps as $step) {
    (new $step())->buildAll();
  }
}

if (\array_key_exists(1, $argv)) {
  build_site(\array_slice($argv, 1));
} else {
  build_site();
}

echo "\n"; // Make the bash prompt nice after :p
