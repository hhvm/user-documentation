<?hh // strict
/**
 * This file is generated. Do not modify it manually!
 *
 * To re-generate this file run /var/www/bin/build.php
 *
 *
 * @generated SignedSource<<6a90f63d11a427c1aac6092a710eacc5>>
 */

class StaticResourcesControllerParameters
  extends \FredEmmott\HackRouter\RequestParametersCodegen {

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

  final public function getParameters(): StaticResourcesControllerParameters {
    $params = $this->getParameters_PRIVATE_IMPL();
    return new StaticResourcesControllerParameters($params);
  }
}
