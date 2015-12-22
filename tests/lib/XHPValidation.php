<?hh // strict

namespace HHVM\UserDocumentation\Tests;

abstract final class XHPValidation {
  public static function disable(): void {
    // UNSAFE: :xhp namespace brokenness... use mangled name
    \xhp_xhp::$ENABLE_VALIDATION = false;
  }

  public static function enable(): void {
    // UNSAFE: :xhp namespace brokenness... use mangled name
    \xhp_xhp::$ENABLE_VALIDATION = true;
  }
}
