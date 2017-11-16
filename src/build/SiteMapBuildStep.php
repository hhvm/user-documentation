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

final class SiteMapBuildStep extends BuildStep {
  const string ROOT = 'https://docs.hhvm.com';

  public function buildAll(): void {
    Log::i("\nBuilding Google Site Map");
    $url_lists = ImmVector {
      $this->getIndexPages(),
      $this->getAPIPages(),
      $this->getGuidePages(),
    };

    $combined = Vector { };
    foreach ($url_lists as $url_list) {
      $combined->addAll($url_list);
    }
    invariant(
      count($combined) < 50000,
      'more than 50,000 URLs in sitemap, need to split sitemap for Google',
    );

    $combined = $combined
      ->map($x ==> self::ROOT.$x)
      ->map($x ==> $x."\n");
    $text = implode('', $combined);

    invariant(
      strlen($text) < 50 * 1024 * 1024,
      'site map > 50MB, need to split sitemap for Google',
    );

    file_put_contents(
      BuildPaths::SITE_MAP,
      $text,
    );
  }

  private function getIndexPages(): ImmVector<string> {
    return ImmVector {
      '/',
      '/hack/',
      '/hhvm/',
      '/hack/reference/',
    };
  }

  private function getAPIPages(): ImmVector<string> {
    return $this->getPagesFromNavData(APINavData::getNavData());
  }

  private function getGuidePages(): ImmVector<string> {
    return $this->getPagesFromNavData(GuidesNavData::getNavData());
  }

  private function getPagesFromNavData(
    array<string, NavDataNode> $roots,
  ): ImmVector<string> {
    $out = Vector { };
    $to_visit = array_values($roots);
    while ($node = array_shift($to_visit)) {
      foreach ($node['children'] as $child) {
        $to_visit[] = $child;
      }
      $out[] = $node['urlPath'];
    }
    return $out->toImmVector();
  }
}
