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

use namespace HH\Lib\{C, Str, Vec};

final class APISourcesBuildStep extends BuildStep {
  const type TRepoSpec = shape(
    'name' => string,
    'prefixes' => keyset<string>,
  );

  const dict<APIProduct, this::TRepoSpec> REPOSITORIES = dict[
    APIProduct::HACK => shape(
      'name' => 'facebook/hhvm',
      'prefixes' => keyset[
        'hphp/test/run.php',
        'hphp/test/config.ini',
        'hphp/tools/timeout.sh', // used by run.php
        'hphp/system/php',
        'hphp/runtime/ext',
        'hphp/hack/hhi',
        'hphp/hsl/src',
      ],
    ),
    APIProduct::HSL_EXPERIMENTAL => shape(
      'name' => 'hhvm/hsl-experimental',
      'prefixes' => keyset[
        'src/debug/',
      ],
    ),
  ];

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nFetching API sources...");
    if (HHAPIDocBuildStep::shouldSkip()) {
      Log::i("\n  ...not needed because the dependent step is being skipped.");
      return;
    }

    foreach (self::REPOSITORIES as $product => $spec) {
      $repo = $spec['name'];
      $local = C\lastx(Str\split($repo, '/'));
      $tag = PRODUCT_TAGS[$product];
      Log::i("\n  Fetching %s@%s...", $repo, $tag);
      $local_abs = Str\format('%s/api-sources/%s', LocalConfig::ROOT, $local);
      $tag_file = $local_abs.'/.tag';
      if (
        \file_exists($tag_file) &&
        \file_get_contents($tag_file) === self::getTagFileContent($product)
      ) {
        Log::i("\n  ...already present.");
        continue;
      }
      \shell_exec('rm -rf -- '.\escapeshellarg($local_abs));
      $gzipped = \file_get_contents(
        Str\format('https://github.com/%s/archive/%s.tar.gz', $repo, $tag),
      );
      Log::i("\n  Extracting tarball...");
      $tar = \gzdecode($gzipped);
      if ($tar === false) {
        Log::e("\ngzdecode failed.");
        exit(1);
      }
      Util\parse_tar(
        (string)$tar,
        ($metadata, $content) ==> {
          $path = Str\split($metadata['path'], '/')
            |> Vec\drop($$, 1)
            |> Str\join($$, '/');
          if (!C\any($spec['prefixes'], $p ==> Str\starts_with($path, $p))) {
            return;
          }
          $path = $local_abs.'/'.$path;
          $parent = \dirname($path);
          if (!\is_dir($parent)) {
            \mkdir($parent, /* mode = */ 0755, /* recursive = */ true);
          }
          switch ($metadata['type']) {
            case Util\TarEntryType::FILE:
              \file_put_contents($path, $content);
              break;
            case Util\TarEntryType::SYMLINK:
              \symlink($content as nonnull, $path);
              break;
            case Util\TarEntryType::DIRECTORY:
              \mkdir($path, 0755);
              break;
          }
          \chmod($path, $metadata['mode']);
        },
      );
      \file_put_contents($tag_file, self::getTagFileContent($product));
    }
  }

  <<__Memoize>>
  public static function getTagFileContent(APIProduct $product): string {
    // Include the hash of this file so that we refetch+extract if the
    // prefix list changes
    return Str\format(
      "tag: %s\nbuild step source hash: %s\n",
      PRODUCT_TAGS[$product],
      \sha1(\file_get_contents(__FILE__)),
    );
  }
}
