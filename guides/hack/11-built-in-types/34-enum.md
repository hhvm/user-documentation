Use an enum (enumerated type) to create a set of named, constant, immutable values. 

In Hack, enums are limited to `int` or `string` (as an [`Arraykey`](/hack/built-in-types/arraykey)), or other `enum` values.

## Quickstart
To access an enum's value, use its full name, as in `Colors::Blue` or `Permission::Read`.

```Colors.hack no-auto-output
enum Colors: int {
  Red = 3;
  Green = 5;
  Blue = 10;
  Default = 3; // duplicate value is okay
}
```

```Permission.hack no-auto-output
enum Permission: string {
  Read = 'R';
  Write = 'W';
  Execute = 'E';
  Delete = 'D';
}
```

Additionally, by using the [`as`](/hack/expressions-and-operators/type-assertions#enforcing-types-with-as-and-as) operator to enforce type, you can initialize your enum with static expressions that reference other enum values.

```BitFlags.hack no-auto-output
enum BitFlags: int as int {
  F1 = 1; // value 1
  F2 = BitFlags::F1 << 1; // value 2
  F3 = BitFlags::F2 << 1; // value 4
  F4 = 4 + 3; // value 7
}
```

## Full Example
With an enum, we can create a placement-direction system with names like `Top`, `Bottom`, `Left`, `Right`, and `Center`, then direct output accordingly to write text to the top, bottom, left, right, or center of a window.

```Positions.inc.hack no-auto-output
enum Position: int {
  Top = 0;
  Bottom = 1;
  Left = 2;
  Right = 3;
  Center = 4;
}

function writeText(string $text, Position $pos): void {
  switch ($pos) {
    case Position::Top:
      // ...
      break;
    case Position::Center:
      // ...
      break;
    case Position::Right:
      // ...
      break;
    case Position::Left:
      // ...
      break;
    case Position::Bottom:
      // ...
      break;
  }
}

<<__EntryPoint>>
function main(): void {
  writeText("Hello", Position::Bottom);
  writeText("Today", Position::Left);
}
```

## Library Methods
All enums implement these public static methods.

### `getNames() / getValues()`
Returns a map-like array of enum constant values and their names.

```NamesValues.hack
enum Position: int {
  Top = 0;
  Bottom = 1;
  Left = 2;
  Right = 3;
  Center = 4;
}

<<__EntryPoint>>
function main(): void {
  $names = Position::getNames();
  echo " Position::getNames() ---\n";
  foreach ($names as $key => $value) {
    echo "\tkey >$key< has value >$value<\n";
  }

  $values = Position::getValues();
  echo "Position::getValues() ---\n";
  foreach ($values as $key => $value) {
    echo "\tkey >$key< has value >$value<\n";
  }
}
```

### `assert()` / `coerce()`
`assert($value)` checks if a value exists in an enum, and if it does, returns the value; if the value does not exist, throws an `UnexpectedValueException`.

`coerce($value)` checks if a value exists in an enum, and if it does, returns the value; if the value does not exist, returns `null`.

```Assert.hack.type-errors no-auto-output
enum Bits: int {
  B1 = 2;
  B2 = 4;
  B3 = 8;
 }

<<__EntryPoint>>
function main(): void {
  Bits::assert(2); // 2
  Bits::assert(16); // UnexpectedValueException

  Bits::coerce(2); // 2
  Bits::coerce(2.0); // null
  Bits::coerce(16); // null
}
```

### `assertAll()`
`assertAll($traversable)` calls `assert($value)` on every element of the traversable (e.g. [Hack Arrays](/hack/arrays-and-collections/hack-arrays)); if at least one value does not exist, throws an `UnexpectedValueException`.


```AssertAll.hack.type-errors no-auto-output
enum Bits: int {
  B1 = 2;
  B2 = 4;
  B3 = 8;
 }

<<__EntryPoint>>
function main(): void {
  $all_values = vec[2, 4, 8];
  $some_values = vec[2, 4, 16];
  $no_values = vec[32, 64, 128];

  Bits::assertAll($all_values); // vec[2, 4, 8]
  Bits::assertAll($some_values); // throws on 16, UnexpectedValueException
  Bits::assertAll($no_values); // throws on 32, UnexpectedValueException
}
```

### `isValid()`
`isValid($value)` checks if a value exists in an enum, and if it does, returns `true`; if the value does not exist, it returns `false`.

```IsValid.hack
enum Bits: int {
  B1 = 2;
  B2 = 4;
  B3 = 8;
 }

<<__EntryPoint>>
function main(): void {
  \var_dump(Bits::isValid(2));
  \var_dump(Bits::isValid(2.0));
  \var_dump(Bits::isValid("2.0"));
  \var_dump(Bits::isValid(8));
}
```

## Enum Inclusion
You can define an enum to include all of the constants of another enum with the `use` keyword.

In the following example, `enum` `F` contains all of the constants of `enum` `E1` and `enum` `E2`.

```EnumSupertyping.hack no-auto-output
enum E1: int as int {
  A = 0;
}
enum E2: int as int {
  B = 1;
}
enum F: int {
  // same-line alternative: use E1, E2;
  use E1;
  use E2;
  C = 2;
}
```

Enum Inclusion is subject to a few restrictions:
* **Order**: All `use` statements must precede enum constant declarations.
* **Uniqueness**: All constant names across all enums must be unique.
* **Subtype Relation**: In the above example, `E1` and `E2` are not considered subtypes of `F`; that is, the Hack Typechecker rejects passing `E1::A` or `E2::B` to a function that expects an argument of type `F`. 

**Note:** Library functions like `getNames()` and `getValues()` perform a post-order traversal of all included enums.