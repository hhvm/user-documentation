<?hh // strict

namespace Hack\UserDocumentation\Types\Arrays\Examples\ReferenceSemantics;

use namespace HH\Lib\Str;

<<__EntryPoint>>
function main(): void {
  \__init_autoload();
  $john = new Person('John', 'Doe');
  $emma = new Person('Emma', 'Smith');

  echo Str\format(
    "%s's last name was %s before she got married.\n",
    $emma->firstName,
    $emma->lastName,
  );

  marry($john, $emma);

  echo Str\format(
    "%s's last name became %s after she got married.\n",
    $emma->firstName,
    $emma->lastName,
  );
}

function marry(Person $a, Person $b): void {
  $b->lastName = $a->lastName;
}

class Person {
  public function __construct(
    public string $firstName,
    public string $lastName,
  ) {}
}
