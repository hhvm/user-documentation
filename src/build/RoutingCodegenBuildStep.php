<?hh // strict

namespace HHVM\UserDocumentation;

use Facebook\HackCodegen as hcg;
use Facebook\HackRouter\Codegen;
use FredEmmott\TypeAssert\TypeAssert;

final class RoutingCodegenBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nBuilding Router-related codegen...");
    Codegen::forTree(
      LocalConfig::ROOT.'/src/site',
      shape(
        'controllerBase' => \RoutableController::class,
        'router' => self::getRouterConfig(),
        'requestParameters' => self::getRequestParametersConfig(),
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
        $class = TypeAssert::isClassnameOf(\WebController::class, $class);
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
}
