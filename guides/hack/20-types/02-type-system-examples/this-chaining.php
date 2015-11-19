<?hh

namespace Hack\UserDocumentation\Types\TypeSystem\Examples\ThisChaining;

class Vehicle {
  private ?int $numWheels;
  private ?string $make;

  public function setNumWheels(int $num): this {
    $this->numWheels = $num;
    return $this;
  }

  public function setMake(string $make): this {
    $this->make = $make;
    return $this;
  }
}

class Car extends Vehicle {
  private ?bool $autoTransmission;

  public function setAutomaticTransmission(bool $automatic): this {
    $this->autoTransmission = $automatic;
    return $this;
  }
}

class Hybrid extends Car {
  private ?bool $pluggable;

  public function setPluggable(bool $pluggable): this {
    $this->pluggable = $pluggable;
    return $this;
  }

  public function drive(): void {}
}


function run(): void {
  $h = new Hybrid();
  // $h->NumWheels(4) returns the instance so you can immediately call
  // setMake('Tesla') in a chain format, and so on. Finally culminating in an
  // actionable method call, drive().
  $h->setNumWheels(4)
    ->setMake('Tesla')
    ->setAutomaticTransmission(true)
    ->setPluggable(true)
    ->drive();
  var_dump($h);
}

run();
