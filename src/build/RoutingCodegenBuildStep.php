<?hh // strict

namespace HHVM\UserDocumentation;

use Facebook\HackCodegen as hcg;
use FredEmmott\HackRouter\Codegen;
use FredEmmott\TypeAssert\TypeAssert;

final class RoutingCodegenBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nBuilding Router-related codegen...");
    Codegen::forTree(
      LocalConfig::ROOT.'/src/site',
      shape(
        'controller_base' => \RoutableController::class,
        'router' => self::getRouterConfig(),
        'request_parameters' => self::getRequestParametersConfig(),
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
      'get_parameters' => $class ==> {
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
        'methodImplementation' => $spec ==>
          hcg\hack_builder()
            ->addAssignment(
              '$params',
              '$this->getParameters_PRIVATE_IMPL()',
            )
            ->addReturn(
              'new %s($params)',
              $spec['class']['name'],
            )
            ->getCode(),
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
