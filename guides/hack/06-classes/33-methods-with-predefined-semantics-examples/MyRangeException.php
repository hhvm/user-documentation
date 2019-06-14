<?hh // strict

namespace Hack\UserDocumentation\Classes\PredefinedMethods\Examples\MyRangeException;

class MyRangeException extends \Exception {
  public function __toString(): string {
    return parent::__toString() . ">>MyRangeException stuff<<";
  }
  // ...
}
