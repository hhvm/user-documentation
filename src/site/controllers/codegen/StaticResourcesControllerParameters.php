<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run bin/build.php
 *
 *
 * @generated SignedSource<<2b1643c7a6d4c0787103bd466402d3dd>>
 */

class StaticResourcesControllerParameters
  extends \Facebook\HackRouter\RequestParametersCodegen {

  final public function getChecksum(): string {
    return $this->getParameters()->getString('Checksum');
  }

  final public function getFile(): string {
    return $this->getParameters()->getString('File');
  }

  final public function getMTime(): ?int {
    return $this->getParameters()->getOptionalInt('MTime');
  }
}

trait StaticResourcesControllerParametersTrait {

  require extends \WebController;

  final protected function getParameters(
  ): StaticResourcesControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new StaticResourcesControllerParameters($params);
  }
}
