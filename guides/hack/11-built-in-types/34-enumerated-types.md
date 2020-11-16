The core primitive types are not always the best type for a variable or property. Yes, `bool` allows us to store answers to Yes/No questions,
and `?bool` allows us to store an extra value, (don't know/not available), but what is the best way to represent something like a variable
that has more than three, but less than say 10 states? For example, when working with some sort of windowing system, we might want placement-direction
values like Top, Bottom, Left, Right, and Center.  And while we could use `int`, that type allows far more invalid values than there are valid ones.
The solution is to use an enumerated type and its associated values. For example:

```Positions.inc.php no-auto-output
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

As multiple enumerated types can have enumeration constants of the same name, when referring to an enumeration constant, we must qualify it with
its parent enumerated type name, as in `Position::Top`.

An enumeration consists of a set of zero or more named, constant values called *enumeration constants* having type `int` or `string`.
Each distinct enumeration constitutes a different enumerated type. An instance of an enumerated type is called an *enum*. Each enumerated
type has a corresponding underlying type, which is limited to `int` or `string`.  As we can see above, the type `enum Position` has an underlying
type of `int`, and a set of five constant values `Top`, `Bottom`, `Left`, `Right`, and `Center`, with the corresponding values 0-4. (The choice
of values is up to the programmer.) And while enumerated constant within any given enumerated type must be distinct, multiple constants *can*
be given the *same* value. For example:

```Colors.php no-auto-output
enum Colors: int {
  Red = 3;
  White = 5;
  Blue = 10;
  Default = 3; // duplicate value is okay
}
```

The initializer for an enumeration can contain non-trivial constant expressions including references to the names of other enumeration-constants
in the same enumerated type.  For example:

```BitFlags.php no-auto-output
enum BitFlags: int as int {
  F1 = 1; // value 1
  F2 = BitFlags::F1 << 1; // value 2
  F3 = BitFlags::F2 << 1; // value 4
}
```

Here, the underlying type has a *type constraint* (via an `as` clause). In the absence of the constraint, the type of `F1`, `F2`, and `F3`
is `enum BitFlags`, which is not an integer type.  So, it can't be involved in bit-shifting. However, with the constraint, their type is
that of the constraint, in this case, `int`.  This allows these enumeration constants to be used in the context of an `int` (such as with
the relational or bitwise operators), but not vice versa.

Here's an example that uses enumeration constants with `string` values:

```Permission.php no-auto-output
enum Permission: string {
  Read = 'R';
  Write = 'W';
  Execute = 'E';
  Delete = 'D';
}
```

All enumerated types behave as if they contain a set of public static methods.

Here is an example that uses several of these methods:

```Positions.enum-methods.php
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
```
