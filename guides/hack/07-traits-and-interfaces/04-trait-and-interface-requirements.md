Trait and interface requirements allow you to restrict the use of these constructs by specifying what classes may actually use a trait or
implement an interface. This can simplify long lists of `abstract` method requirements, and provide a hint to the reader as to the
intended use of the trait or interface.

## Syntax

To introduce a trait requirement, you can have one or more of the following in your trait:

```Hack
require extends <class name>;
require implements <interface name>;
```

To introduce an interface requirement, you can have one or more of following in your interface:

```Hack
require extends <class name>;
```

## Traits

Here is an example of a trait that introduces a class and interface requirement, and shows a class that meets the requirement:

```trait-good.hack
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
```

Here is an example of a trait that introduces a class and interface requirement, and shows a class that *does not* meet the requirement:

```trait-bad.hack.type-errors
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

// Having this will not only cause a typechecker error, but also cause a fatal
// error in HHVM since we did not meet the trait requirement.
class Paper implements Fliers {
  use Plane;

  public function fly(): bool {
    return false;
  }
}

<<__EntryPoint>>
function run(): void {
  // This code will not run in HHVM because of the problem mentioned above.
  $p = new Paper();
  \var_dump($p);
  \var_dump($p->takeOff());
}
```

**NOTE**: `require extends` should be taken literally. The class *must* extend the required class; thus the actual required class
**does not** meet that requirement. This is to avoid some subtle circular dependencies when checking requirements.

## Interfaces

Here is an example of an interface that introduces a class requirement, and shows a class that meets the requirement:

```interface-good.hack
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
```

Here is an example of an interface that introduces a class requirement, and shows a class that *does not* meet the requirement:

```interface-bad.hack.type-errors
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

// Having this will not only cause a typechecker error, but also cause a fatal
// error in HHVM since we did not meet the interface requirement (extending
// Machine).
class Paper implements Fliers {
  public function fly(): bool {
    return false;
  }
}

<<__EntryPoint>>
function run(): void {
  // This code will actually not run in HHVM because of the fatal mentioned
  // above.
  $p = new Paper();
  \var_dump($p);
  \var_dump($p->takeOff());
}
```

