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

use namespace HH\Lib\Str;
use namespace Facebook\HackCodegen as CG;

final class GuidesIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nGuidesIndexBuild");

    $sources = self::findSources(BuildPaths::GUIDES_MARKDOWN, Set {'md'});
    \sort(inout $sources);

    $this->createIndex($sources);
  }

  private function createIndex(Traversable<string> $list): void {
    $index = $this->generateIndexData($list);

    $cg = $this->getCodegenFactory();
    $cg->codegenFile(BuildPaths::GUIDES_INDEX)
      ->setNamespace("HHVM\\UserDocumentation")
      ->addClass(
        $cg->codegenClass('GuidesIndexData')
          ->setIsFinal(true)
          ->setIsAbstract(true)
          ->addMethod(
            $cg->codegenMethod('getIndex')
              ->setIsStatic(true)
              ->setReturnType(
                'dict<GuidesProduct, dict<string, dict<string, string>>>',
              )
              ->setBody(
                $cg->codegenHackBuilder()
                  ->addReturn(
                    $index,
                    CG\HackBuilderValues::dict(
                      CG\HackBuilderKeys::lambda(
                        ($_, $p) ==> Str\format(
                          'GuidesProduct::%s',
                          GuidesProduct::getNames()[$p],
                        ),
                      ),
                      CG\HackBuilderValues::dict(
                        CG\HackBuilderKeys::export(),
                        CG\HackBuilderValues::dict(
                          CG\HackBuilderKeys::export(),
                          CG\HackBuilderValues::export(),
                        ),
                      ),
                    ),
                  )
                  ->getCode(),
              ),
          ),
      )
      ->save();
    // Make it available to later build steps
    require_once(BuildPaths::GUIDES_INDEX);
  }

  private function generateIndexData(
    Traversable<string> $sources,
  ): dict<GuidesProduct, dict<string, dict<string, string>>> {
    $out = dict[];
    foreach ($sources as $path) {
      $path = \str_replace(BuildPaths::GUIDES_MARKDOWN.'/', '', $path);
      $parts = (new Vector(\explode('/', $path)))
        ->map(
          $part ==> \preg_match('/^[0-9]{2,}-/', $part)
            ? \substr($part, \strpos($part, '-') + 1)
            : $part,
        );
      if (\count($parts) !== 3) {
        continue;
      }

      list($product, $section, $page) = $parts;
      $product as GuidesProduct;
      $page = \basename($page, '.md');
      $out[$product] ??= dict[];
      $out[$product][$section] ??= dict[];

      $absolute = GuidesHTMLBuildStep::getOutputFileName($path);
      $relative = \substr($absolute, \strlen(BuildPaths::GUIDES_HTML) + 1);
      $out[$product][$section][$page] = $relative;
    }
    return $out;
  }
}
