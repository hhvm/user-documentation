<?hh

namespace Hack\UserDocumentation\Classes\TIR\Examples\TraitReqGood;

abstract class Machine {
  public function openDoors(): void {
    return;
  }
  public function closeDoors(): void {
    return;
  }
}
interface Fliers {
  public function fly(): bool;
}

trait Plane {
  require extends Machine;
  require implements Fliers;

  public function takeOff(): bool {
    $this->openDoors();
    $this->closeDoors();
    return $this->fly();
  }
}

class AirBus extends Machine implements Fliers {
  use Plane;

  public function fly(): bool {
    return true;
  }
}

<<__EntryPoint>>
function run(): void {
  $ab = new AirBus();
  \var_dump($ab);
  \var_dump($ab->takeOff());
}
