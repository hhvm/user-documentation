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

use type Facebook\DefinitionFinder\{
  FileParser,
  ScannedBase,
  ScannedBasicClass,
  ScannedClass,
  ScannedFunctionAbstract,
  ScannedInterface,
  ScannedMethod,
  ScannedTrait,
};
use namespace Facebook\HHAPIDoc;
use namespace Facebook\HHAPIDoc\Documentables;
use type Facebook\HHAPIDoc\{Documentable, Documentables};
use namespace HH\Lib\{Dict, Str, Vec};

final class HHAPIDocMarkdownBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    Log::i("\nHHAPIDocBuildStep");

    if (!\getenv('USE_HH_APIDOC')) {
      Log::v('[skip]');
      return;
    }

    $exts = ImmSet { 'php', 'hhi', 'hh' };

    Log::i("\nFinding Builtin Sources");
    $builtin_sources = Vec\concat(
      self::findSources(BuildPaths::HHVM_TREE.'/hphp/system/php/', $exts),
      self::findSources(BuildPaths::HHVM_TREE.'/hphp/runtime/ext/', $exts),
      self::findSources(BuildPaths::HHVM_TREE.'/hphp/hack/hhi/', $exts),
    );
    Log::i("\nParsing Builtin Sources");
    $builtin_defs = self::parse($builtin_sources);
    Log::i("\nDe-duping Builtin Sources");
    $builtin_defs = DataMerger::mergeAll($builtin_defs);
    Log::i("\nGenerating Markdown for Builtins");
    self::buildMarkdown(APIProduct::HACK, $builtin_defs);

    Log::i("\nFinding HSL sources");
    $hsl_sources = self::findSources(BuildPaths::HSL_TREE.'/src/', $exts);
    Log::i("\nParsing HSL sources");
    $hsl_defs = self::parse($hsl_sources);
    Log::i("\nGenerating HSL markdown");
    self::buildMarkdown(APIProduct::HSL, $hsl_defs);
  }

  private static function parse(Traversable<string> $sources): Documentables {
    return $sources
      |> Vec\map($$, $file ==> FileParser::FromFile($file))
      |> Vec\map($$, $parser ==> Documentables\from_parser($parser))
      |> Dict\flatten($$);
  }

  private static function buildMarkdown(
    APIProduct $product,
    Documentables $documentables,
  ): vec<string> {
    $out = BuildPaths::APIDOCS_MARKDOWN.'/'.$product;

    if (!\is_dir($out)) {
      \mkdir($out, /* mode = */ 0755, /* recursive = */ true);
    }
    $ctx = new HHAPIDoc\MarkdownBuilderContext(
      new HHAPIDocExt\PathProvider()
    );
    $builder = new HHAPIDocExt\MarkdownBuilder($ctx);

    return Vec\map($documentables, $documentable ==> {
      Log::v('.');
      $md = $builder->getDocumentation($documentable);
      $what = $documentable['definition'];
      $type = self::getAPIDefinitionType($what);
      switch ($type) {
        case APIDefinitionType::FUNCTION_DEF:
          if ($parent = $documentable['parent']) {
            $path = 'class.'.$parent->getName().'.method.'.$what->getName();
            break;
          }
          $path = ''; // hack error
          // FALLTHROUGH
        case APIDefinitionType::CLASS_DEF:
        case APIDefinitionType::INTERFACE_DEF:
        case APIDefinitionType::TRAIT_DEF:
          $path = $type.'.'.$what->getName();
          break;
      }
      $path = \sprintf(
        '%s/%s/%s.md',
        BuildPaths::APIDOCS_MARKDOWN,
        $product,
        Str\replace($path, "\\", '.'),
      );
      \file_put_contents($path, $md."\n<!-- HHAPIDOC -->\n");
      return $path;
    });
  }

  private static function getAPIDefinitionType(
    ScannedBase $definition,
  ): APIDefinitionType {
    if ($definition instanceof ScannedBasicClass) {
      return APIDefinitionType::CLASS_DEF;
    }
    if ($definition instanceof ScannedInterface) {
      return APIDefinitionType::INTERFACE_DEF;
    }
    if ($definition instanceof ScannedTrait) {
      return APIDefinitionType::TRAIT_DEF;
    }
    if ($definition instanceof ScannedFunctionAbstract) {
      return APIDefinitionType::FUNCTION_DEF;
    }
    invariant_violation(
      "Can't handle type %s",
      \get_class($definition),
    );
  }
}
