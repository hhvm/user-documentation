// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\TraitsAndInterfaces\TraitAndInterfaceRequirements\InterfaceGood;

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
  \init_docs_autoloader();

  $ab = new AirBus();
  \var_dump($ab);
  \var_dump($ab->takeOff());
}
