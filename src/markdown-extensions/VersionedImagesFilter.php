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

namespace HHVM\UserDocumentation\MarkdownExt;

use type HHVM\UserDocumentation\StaticResourceMap;
use type Facebook\Markdown\{ASTNode, RenderContext, RenderFilter};
use namespace Facebook\Markdown\Inlines;
use namespace HH\Lib\Str;

final class VersionedImagesFilter extends RenderFilter {
  <<__Override>>
  public function filter(RenderContext $_, ASTNode $node): vec<ASTNode> {
    if (!$node is Inlines\Image) {
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
}
