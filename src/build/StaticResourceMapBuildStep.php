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

final class StaticResourceMapBuildStep extends BuildStep {
  private static function getTypes(): Map<string, string> {
    return Map {
      'css' => 'text/css',
      'js' => 'application/javascript',
      'png' => 'image/png',
      'svg' => 'image/svg+xml',
      // FIXME: NEEDS LESS JPEG (#81)
      'jpg' => 'image/jpeg',
      'jpeg' => 'image/jpeg',
      'otf' => 'application/vnd.ms-opentype',
      'eot' => 'application/vnd.ms-fontobject',
      'ttf' => 'application/x-font-ttf',
      'woff' => 'application/x-font-woff',
      'woff2' => 'font/woff2',
    };
  }

  <<__Memoize>>
  private static function getRoot(): string {
    return realpath(LocalConfig::ROOT.'/public/');
  }

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nStaticResourcesMapBuild");

    $sources = self::findSources(
      self::getRoot(),
      self::getTypes()->keys()->toSet(),
    );

    $map = self::makeMap($sources);

    \file_put_contents(
      BuildPaths::STATIC_RESOURCES_MAP_JSON,
      JSON\encode_dict($map),
    );
  }

  private static function makeMap(
    vec<string> $sources,
  ): dict<string, StaticResourceMapEntry> {
    $map = dict[];

    $prefix_len = strlen(self::getRoot());

    $mimetype_map = self::getTypes();

    foreach ($sources as $source) {
      $relative = substr($source, $prefix_len);
      $full_hash = hash('sha256', file_get_contents($source));
      $ext = pathinfo($source, PATHINFO_EXTENSION);

      $map[$relative] = shape(
        'localPath' => $source,
        'checksum' => substr($full_hash, 0, 16),
        'mtime' => filemtime($source),
        'mimeType' => $mimetype_map->at($ext),
      );
    }

    return $map;
  }
}
