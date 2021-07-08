**Disclaimer: This is a new feature, and you will have to enable it in your projects**


Historically, the base type of an enumerated type (enum) is restricted to the `arraykey` type: it must be an integer, a string or another enum.
This feature enables more types as base type for enumerations, as long as the type doesn’t have any generics:
if an enum has type `t` as base type, then its enum constants are bound to values whose type is a subtype of `t`.

Our main goal here is to allow more expressivity and replace some generated / boiler plate code: associating enum constants to different subtypes
of the base type provides a lightweight form of dependent types that can be used as type-safe abstraction to write generic validator/sanitiser/loggers boiler-plate code.

Here are a couple of simple examples:

```EnumClassIntro.hack no-auto-output
// Simple enum class where we allow any type
enum class Random : mixed {
  int X = 42;
  string S = 'foo';
}

// enum classes that mimics a normal enum
enum class Ints : int {
  int A = 0;
  int B = 10;
}

// Some class definitions to make a more involved example
interface IHasName {
  public function name() : string;
}

class HasName implements IHasName {
  public function __construct(private string $name)[] {}
  public function name() : string {
    return $this->name;
  }
}

class ConstName implements IHasName {
  public function name(): string {
    return "bar";
  }
}

// enum class which base type is the IHasName interface: each enum constant
// can be any subtype of IHasName, here we see HasName and ConstName
enum class Names : IHasName {
  HasName Hello = new HasName('hello');
  HasName World = new HasName('world');
  ConstName Bar = new ConstName();
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

## Declaring a new enum class

Enum classes are syntactically different from existing enum types, as they require:

* the `enum class` keyword rather than the `enum` keyword
* that each constant is annotated with its precise type, as in `HasName Hello = ...`

Once declared, enum class constants are accessed like normal enum constants using the `::` operator: `Names::Hello`, `Names::Bar`, ...


### The `HH\MemberOf` alias

Another difference is that their types are more informative. Consider the enum:

```EnumClassEnum.hack no-auto-output
enum E : int {
  A = 42;
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

The type of `E::A` is just `E`.


```EnumClassEC.hack no-auto-output
enum class EC : int {
  int A = 42;
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

If we now look at `EC::A`, its type is `HH\MemberOf<EC, int>`.


Let's have a look back at `Names::World`, its type is `HH\MemberOf<Names, HasName>`, and `Names::Bar` has type `HH\MemberOf<Names, ConstName>`.

The addition of this type layer is here to give more information about the enumeration, namely its exact type
(`HasName` vs `IHasName`) and from which enum class it comes from (`Names`).
`HH\MemberOf` is designed to allow a transparent access to the underlying value: `HH\MemberOf<Names, HasName> <: HasName`.
This means that this layer can be ignored if one doesn’t need the additional information, and `Names::Hello` can be used directly as an instance of the `HasName` class:

```EnumClassIntro.names.code0.hack no-auto-output
function expect_name(HasName $x) : void {}
// Names::Hello has type HH\MemberOf<Names, HasName>

function test0(): void {
  expect_name(Names::Hello); // ok !
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

## Defining function that expects enum class

As previously explained, it is completely fine to use enum class constants as an instance of their declared type:

```EnumClassIntro.names.code1.hack no-auto-output
function show_name_interface(IHasName $x) : string {
  return $x->name();
}

function show_name(HasName $x) : string {
  return $x->name();
}

function test1(): void {
  show_name(new HasName('toto')); // Ok
  show_name_interface(Names::Bar); // Ok
  show_name(Names::Hello); // Ok
  // show_name(new ConstName()); // error, ConstName is not a subtype of HasName
  // show_name(Names::Bar); // error, ConstName is not a subtype of HasName
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

To access the additional information added by `HH\MemberOf`, one has to change the function signature in the following way:

```EnumClassIntro.names.code2.hack no-auto-output
function show_name_from_names(\HH\MemberOf<Names, IHasName> $x): string {
  echo "Showing names from the enum class `Names` only";
  return $x->name(); // HH\MemberOf is transparent to the runtime
}

function test2(): void {
  show_name(new HasName('toto')); // error, this instance is not from the Names enum
  show_name(Names::World); // no problem
}

enum class OtherNames: IHasName {
  HasName Foo = new HasName('foo');
}

function test3(): void {
  show_name(OtherNames::Foo); // error, expected Names but got OtherNames
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```


As explained in the introduction, this feature also allows to write dependently typed code. Let’s consider the more involved code:

```EnumClassBox.definition.hack no-auto-output
interface IBox {}

class Box<T> implements IBox {
  public function __construct(public T $data)[] {}
}

enum class Boxes : IBox {
  Box<int> Age = new Box(42);
  Box<string> Color = new Box('red');
  Box<int> Year = new Box(2021);
}

function get<T>(\HH\MemberOf<Boxes, Box<T>> $box) : T {
  return $box->data;
}

function test0(): void {
  get(Boxes::Age); // ok, of type int, returns 42
  get(Boxes::Color); // ok, of type string, returns 'red'
  get(Boxes::Year); // ok, of type int, returns 2021
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

Here we have a simple example of dependent typing: the return value of the `get` function depends on which constant is passed as an input. We can even make it more strict:

```EnumClassBox.code0.hack no-auto-output
function get_int(\HH\MemberOf<Boxes, Box<int>> $box) : int {
  return $box->data;
}

function test1(): void {
  get_int(Boxes::Age); // ok
  // get_int(Boxes::Color); // type error, Color is not a Box<int>
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

## Extending an existing enum class

Enum classes can be composed together, as long as they implement the same base type:

```EnumClassBox.extends0.hack no-auto-output
enum class EBase : IBox {
  Box<int> Age = new Box(42);
}

enum class EExtend : IBox extends EBase {
  Box<string> Color = new Box('red');
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

In this example, `EExtend` inherits `Age` from `EBase`, which means that `EExtend::Age` is defined.
As with ordinary class extension, using the `extends` keyword will create a subtype relation between the enums: `EExtend <: EBase`.
Enum classes support multiple inheritance as long as there is no ambiguity in the names of the constants, and that each enum class uses the same base type:

```EnumClassBox.extends1.hack no-auto-output
enum class E : IBox {
  Box<int> Age = new Box(42);
}

enum class F : IBox {
  Box<string> Name = new Box('foo');
}

enum class X : IBox extends E, F { } // ok, no ambiguity


enum class E0 : IBox extends E {
  Box<int> Color = new Box(0);
}

enum class E1 : IBox extends E {
  Box<string> Color = new Box('red');
}

// enum class Y : IBox extends E0, E1 { }
// type error, Y::Color is declared twice, in E0 and in E1
// only he name is use for ambiguity
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

### Diamond shape scenarios
Enum classes support diamond shaped inheritance as long as there is no ambiguity, like int:

```EnumClassBox.extends2.hack no-auto-output
enum class DiamondBase : IBox {
  Box<int> Age = new Box(42);
}

enum class D1 : IBox extends DiamondBase {
  Box<string> Name1 = new Box('foo');
}

enum class D2 : IBox extends DiamondBase {
  Box<string> Name2 = new Box('bar');
}

enum class D3 : IBox extends D1, D2 {}

<<__EntryPoint>>
function main() : void {
  echo D3::Age->data;
}
```

Here there is no ambiguity: the constant `Age` is inherited from `DiamondBase`, and only from there.
The `main` function will echo `42` as expected.

If either `D1`, `D2` or `D3` tries to define a constant named `Age`, there will be an error.

### Control over inheritance

Enum classes support the `__Sealed` attribute, just like normal classes. This will enable a more fine grain control over the extension mechanics.
However enum classes do not yet support the `final` keyword.

## Control over enum class constants

Using [coeffects](../contexts-and-capabilities/introduction.md), one can have control over what kind of expressions are allowed as enum class constants. Please refer to the coeffects documentation for more details about this feature.

By default, all enum classes are under the `write_props` context. It is not possible to override this explicitly. The only work around must be a temporary one involving `HH_FIXME`s.

## Full example: dependent dictionary

First, a couple of general Hack definitions:

```EnumClassFull.definition.hack no-auto-output
function expect_string(string $str) : void {
  echo 'expect_string called with: '.$str."\n";
}

interface IKey {
  public function name(): string;
}

abstract class Key<T> implements IKey {
  public function __construct(private string $name)[] {}
  public function name(): string {
    return $this->name;
  }
  public abstract function coerceTo(mixed $data): T;
}

class IntKey extends Key<int> {
  public function coerceTo(mixed $data): int {
    return $data as int;
  }
}

class StringKey extends Key<string> {
  public function coerceTo(mixed $data): string {
    // random logic can be implemented here
    $s = $data as string;
    // let's make everything in caps
    return Str\capitalize($s);
  }
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

Now let’s create the base definitions for our dictionary

```EnumClassFull.enum.hack no-auto-output
enum class EKeys : IKey {
  // here are a default key, but this could be left empty
  Key<string> NAME = new StringKey('NAME');
}

abstract class DictBase {
  // type of the keys, left abstract for now
  abstract const type TKeys as EKeys;
  // actual data storage
  private dict<string, mixed> $raw_data = dict[];

  // generic code written once which enforces type safety
  public function get<T>(\HH\MemberOf<this::TKeys, Key<T>> $key) : ?T {
    $name = $key->name();
    $raw_data = idx($this->raw_data, $name);
    // key might not be set
    if ($raw_data is nonnull) {
      $data = $key->coerceTo($raw_data);
      return $data;
    }
    return null;
  }

  public function set<T>(\HH\MemberOf<this::TKeys, Key<T>> $key, T $data): void {
    $name = $key->name();
    $this->raw_data[$name] = $data;
  }
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

Now one just need to provide a set of keys and extends `DictBase`:

```EnumClassFull.user0.hack no-auto-output
class Foo { /* user code in here */ }

class MyKeyType extends Key<Foo> {
  public function coerceTo(mixed $data): Foo {
    // user code validation
    return $data as Foo;
  }
}

enum class MyKeys : IKey extends EKeys {
  Key<int> AGE = new IntKey('AGE');
  MyKeyType BLI = new MyKeyType('BLI');
}

class MyDict extends DictBase {
  const type TKeys = MyKeys;
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

```EnumClassFull.user1.hack
<<__EntryPoint>>
function main() : void {
  $d = new MyDict();
  $d->set(MyKeys::NAME, 'tony');
  $d->set(MyKeys::BLI, new Foo());
  // $d->set(MyKeys::AGE, new Foo()); // type error
  expect_string($d->get(MyKeys::NAME) as nonnull);
}
```.ini
hhvm.hack.lang.enable_enum_classes=1
```

## How to enable the feature

To use this new feature, you need to pass the following flags to HHVM/Hack

* hhvm flags: `-d hhvm.hack.lang.enable_enum_classes=1`
* `.hhconfig` flags: `enable_enum_classes=true`
