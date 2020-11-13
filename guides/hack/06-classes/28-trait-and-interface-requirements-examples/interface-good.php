<?hh

namespace Hack\UserDocumentation\Classes\TIR\Examples\InterfaceReqGood;

abstract class Machine {
  public function openDoors(): void {
    return;
  }
  public function closeDoors(): void {
    return;
  }
}
interface Fliers {
  require extends Machine;
  public function fly(): bool;
}

class AirBus extends Machine implements Fliers {
  public function takeOff(): bool {
    $this->openDoors();
    $this->closeDoors();
    return $this->fly();
  }

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
