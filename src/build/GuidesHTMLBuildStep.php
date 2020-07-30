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

use namespace HH\Lib\{Str, Vec};
use namespace Facebook\HackCodegen as CG;

final class GuidesHTMLBuildStep extends AbstractMarkdownRenderBuildStep {
  use CodegenBuildStep;

  const string SOURCE_ROOT = BuildPaths::GUIDES_MARKDOWN;
  const string BUILD_ROOT = BuildPaths::GUIDES_HTML;

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nGuidesHTMLBuild");
    $sources = self::findSources(self::SOURCE_ROOT, Set {'md'})
      |> Vec\filter($$, $path ==> \basename($path) !== 'README.md')
      |> Vec\sort($$);

    $this->renderFiles($sources);

    Log::i("\nCreating summaries");
    $summaries = \glob(self::SOURCE_ROOT.'/*/*/*-summary.txt')
      |> Vec\map($$, $path ==> Str\strip_prefix($path, self::SOURCE_ROOT.'/'))
      |> Vec\sort($$);

    $summary_index = $this->createSummaryIndex($summaries);
    $cg = $this->getCodegenFactory();
    $cg->codegenFile(BuildPaths::GUIDES_SUMMARY)
      ->setNamespace("HHVM\\UserDocumentation")
      ->addClass(
        $cg->codegenClass('GuidesSummaryData')
          ->setIsFinal(true)
          ->setIsAbstract(true)
          ->addMethod(
            $cg->codegenMethod('getData')
              ->setIsStatic(true)
              ->setReturnType('dict<GuidesProduct, dict<string, string>>')
              ->setBody(
                $cg->codegenHackBuilder()
                  ->addReturn(
                    $summary_index,
                    CG\HackBuilderValues::dict(
                      CG\HackBuilderKeys::lambda(
                        ($_, $v) ==> Str\format(
                          "GuidesProduct::%s",
                          GuidesProduct::getNames()[$v],
                        ),
                      ),
                      CG\HackBuilderValues::export(),
                    ),
                  )
                  ->getCode(),
              ),
          ),
      )
      ->save();
  }

  private function createSummaryIndex(
    Traversable<string> $summaries,
  ): dict<GuidesProduct, dict<string, string>> {
    $out = dict[];
    foreach ($summaries as $summary) {
      $parts = (new Vector(\explode('/', $summary)))
        ->map(
          $part ==> \preg_match('/^[0-9]{2,}-/', $part)
            ? \substr($part, \strpos($part, '-') + 1)
            : $part,
        );
      if (\count($parts) !== 3) {
        continue;
      }
      list($product, $section, $_page) = $parts;
      $product as GuidesProduct;
      $out[$product] ??= dict[];
      $out[$product][$section] = $summary;
    }
    return $out;
  }
}
