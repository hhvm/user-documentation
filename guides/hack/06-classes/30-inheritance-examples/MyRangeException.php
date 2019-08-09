<?hh // strict

namespace Hack\UserDocumentation\Classes\Inheritance\Examples\MyRangeException;

class MyRangeException extends \Exception {
  public function __construct(string $message, int $val) {
    parent::__construct($message);
    // ...
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  try {
    throw new MyRangeException("xyz", 123);
  } catch (MyRangeException $e) {
    // ...
  }
}
