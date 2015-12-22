<?hh // strict

namespace HHVM\UserDocumentation\Tests;

final class XHPValidationGuard {
  public function __construct() {
    XHPValidation::disable();
  }

  public function __destruct() {
    XHPValidation::enable();
  }
}
