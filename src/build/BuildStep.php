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

abstract class BuildStep {
  abstract public function buildAll(): void;

  <<__Memoize>>
  protected static function getIndexFile(string $root): ?string {
    if (\file_exists($root.'/index.json')) {
      return $root.'/index.json';
    }

    if (!Str\contains($root, 'api-sources/')) {
      return null;
    }

    $cache_key = null;
    $tag_file = $root
      |> Str\strip_prefix($$, BuildPaths::API_SOURCES_DIR)
      |> Str\strip_prefix($$, '/')
      |> Str\split($$, '/')
      |> C\firstx($$)
      |> Str\format(
        '%s/%s/.tag',
        BuildPaths::API_SOURCES_DIR,
        $$,
      );
    if (!\file_exists($tag_file)) {
      return null;
    }

    $cache_key = \file_get_contents($tag_file)
      |> \sodium_crypto_generichash($$)
      |> \bin2hex($$);

    return Str\format(
      '%s/%s-%s.json',
      BuildPaths::DIR_INDEX_ROOT,
      $root
        |> Str\strip_prefix($$, LocalConfig::ROOT)
        |> Str\strip_prefix($$, '/')
        |> Str\replace($$, '/', '_'),
      $cache_key,
    );
  }

  protected static function findSources(
    string $root,
    \ConstSet<string> $extensions,
  ): vec<string> {
    $root = \realpath($root);
    Log::i("\nFinding sources in %s", $root);

    $index = self::getIndexFile($root);
    if ($index !== null && \file_exists($index)) {
      $files = JSON\decode_as_shape(
        DirectoryIndex::class,
        \file_get_contents($index),
      )['files'];
      Log::v(' (cached)');
      return Vec\filter(
        $files,
        $f ==> C\any($extensions, $ext ==> Str\ends_with($f, '.'.$ext)),
      );
    }

    $rdi = new \RecursiveDirectoryIterator($root);
    $rii = new \RecursiveIteratorIterator(
      $rdi,
      \RecursiveIteratorIterator::CHILD_FIRST,
    );
    $all_files = vec[];
    $files = vec[];
    foreach ($rii as $info) {
      if (!$info->isFile()) {
        continue;
      }
      $all_files[] = $info->getPathname();
      if ($extensions->contains($info->getExtension())) {
        $files[] = $info->getPathname();
        Log::v('.');
      }
    }

    if ($index !== null) {
      if (!\file_exists(BuildPaths::DIR_INDEX_ROOT)) {
        \mkdir(BuildPaths::DIR_INDEX_ROOT, 0755);
      }
      \file_put_contents(
        $index,
        JSON\encode_shape(DirectoryIndex::class, shape('files' => $all_files)),
      );
    }

    return $files;
  }
}
