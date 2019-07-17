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

use type Facebook\HackRouter\Codegen;

use namespace Facebook\{HackCodegen as hcg, TypeAssert};

final class RoutingCodegenBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    Log::i("\nBuilding Router-related codegen...");
    Codegen::forTree(
      LocalConfig::ROOT.'/src/site',
      shape(
        'controllerBase' => \RoutableController::class,
        'router' => self::getRouterConfig(),
        'requestParameters' => self::getRequestParametersConfig(),
        'uriBuilders' => self::getUriBuildersConfig(),
        'hackCodegenConfig' => (new hcg\HackCodegenConfig())
          ->withRootDir(LocalConfig::ROOT),
      ),
    )->build();
  }

  private static function getRouterConfig(): Codegen::TRouterCodegenConfig {
    return shape(
      'file' => LocalConfig::ROOT.'/src/site/RouterCodegenBase.php',
      'class' => 'RouterCodegenBase',
      'abstract' => true,
    );
  }

  private static function getRequestParametersConfig(
  ): Codegen::TRequestParametersCodegenConfig {
    $root = LocalConfig::ROOT.'/src/site/controllers/codegen/';
    return shape(
      'getParameters' => $class ==> {
        $class = TypeAssert\classname_of(\WebController::class, $class);
        $spec = $class::getParametersSpec();
        $out = Vector {};
        foreach ($spec['required'] as $p) {
          $out[] = shape('spec' => $p, 'optional' => false);
        }
        foreach ($spec['optional'] as $p) {
          $out[] = shape('spec' => $p, 'optional' => true);
        }
        return $out->immutable();
      },
      'trait' => shape(
        'requireExtends' => ImmSet {
          \WebController::class,
        },
        'methodName' => 'getParameters',
        'getRawParametersCode' => '$this->getParameters_PRIVATE_IMPL()',
      ),
      'output' => $classname ==> shape(
        'file' => $root.$classname.'Parameters.php',
        'class' => shape(
          'name' => $classname.'Parameters',
        ),
        'trait' => shape(
          'name' => $classname.'ParametersTrait',
        ),
      ),
    );
  }

  private static function getUriBuildersConfig(
  ): Codegen::TUriBuilderCodegenConfig {
    $root = LocalConfig::ROOT.'/src/site/controllers/codegen/';
    return shape(
      'output' => $classname ==> shape(
        'file' => $root.$classname.'URIBuilder.php',
        'class' => shape(
          'name' => $classname.'URIBuilder',
        ),
      ),
    );
  }
}
