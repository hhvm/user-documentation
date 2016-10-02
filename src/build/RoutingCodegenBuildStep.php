<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\HackRouter\Codegen;

final class RoutingCodegenBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nBuilding Router-related codegen...");
    Codegen::forTree(
      LocalConfig::ROOT.'/src/site',
      shape(
        'controller_base' => \RoutableController::class,
        'router' => self::getRouterConfig(),
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
}
