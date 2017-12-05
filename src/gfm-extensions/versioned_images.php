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

use type HHVM\UserDocumentation\StaticResourceMap;
use type Facebook\GFM\ASTNode;
use namespace Facebook\GFM\Inlines;
use namespace HH\Lib\Str;

function versioned_images(
  ASTNode $node,
): vec<ASTNode> {
  if (!$node instanceof Inlines\Image) {
    return vec[$node];
  }

  $path = $node->getSource();
  $entry = StaticResourceMap::getNullableEntryForFile($path);

  if ($entry === null) {
    return vec[$node];
  }

  $versioned_path = \StaticResourcesControllerURIBuilder::getPath(shape(
    'Checksum' => $entry['checksum'],
    'File' => Str\strip_prefix($path, '/'),
  ));

  return vec[
    new Inlines\Image(
      $node->getDescription(),
      $versioned_path,
      $node->getTitle(),
    ),
  ];
}
