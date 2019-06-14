<?hh // strict

namespace Hack\UserDocumentation\Classes\Inheritance\Examples\Vehicles;

abstract class Vehicle {
  public abstract function get_max_speed(): int;
  // ...
}

abstract class Aircraft extends Vehicle {
  public abstract function get_max_altitude(): int;
  // ...
}

class PassengerJet extends Aircraft {
  public function get_max_speed(): int {
    // implement method
    return 500;
  }
  public function get_max_altitude(): int {
    // implement method
    return 35000;
  }
  // ...
}

<<__EntryPoint>>
function main(): void {
  $pj = new PassengerJet();
  echo "\$pj's maximum speed: " . $pj->get_max_speed() . "\n";
  echo "\$pj's maximum altitude: " . $pj->get_max_altitude() . "\n";
}
