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

use type HHVM\UserDocumentation\{StaticResourceMap, StaticResourceMapEntry};

abstract xhp class static:base extends :x:element {
  attribute string path @required;

  abstract protected function getAllowedMimeTypes(): Set<string>;

  final protected function getMimeType(): string {
    return $this->getEntry()['mimeType'];
  }

  final protected function getVersionedURL(): string {
    $info = $this->getEntry();
    $local_path = $info['localPath'];
    $relative_path = $this->:path;

    $mtime = filemtime($local_path);
    if ($info['mtime'] !== $mtime) {
      $url = sprintf('/s/local-changes%s?mtime=%d', $relative_path, $mtime);
    } else {
      $url = sprintf('/s/%s%s', $info['checksum'], $relative_path);
    }
    return $url;
  }

  <<__Memoize>>
  private function getEntry(): StaticResourceMapEntry {
    $url_path = $this->:path;
    // TODO: move to URLBuilder class when #80 merged
    $info = StaticResourceMap::getEntryForFile($url_path);

    invariant(
      $this->getAllowedMimeTypes()->contains($info['mimeType']),
      "can't render %s for file %s of mime type %s",
      static::class,
      $url_path,
      $info['mimeType'],
    );
    return $info;
  }
}
