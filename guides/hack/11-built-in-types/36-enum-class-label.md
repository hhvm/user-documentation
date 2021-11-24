# Experimental feature

This feature is currently experimental and any file that relies on it must start with the following attribute:

`<<file:__EnableUnstableFeatures('enum_class_label')>>`

## Values v. Bindings

With [enum types](enumerated-types) and [enum classes](enum-class), most of the focus is given to their values.
Expressions like `E::A` denote the value of `A` in `E`, but the fact that `A` was used to access it is lost.

```EnumClassLabelIntro.hack no-auto-output
enum E : int {
  A = 42;
  B = 42;
}

function f(E $value) : void {
  switch($value) {
    case E::A: echo "A "; break;
    case E::B: echo "B "; break;
  }
  echo $value . "\n";
}
```
In this example, both `f(E::A)` and `f(E::B)` will echo `A 42` because `E::A` and `E::B` are effectively the value `42` and nothing more.

## Enum Class Labels

Sometimes, the binding that was used to access a value from an enumeration is as important as the value itself. We might want to know that `A`
was used to access `E::A`. Enum types provides a partial solution to this with the `getNames` static method, but it is only
safe to call if all the values of the enumeration are distinct.

Enum classes provides a way to do this by using the newly introduced *Enum Class Label* expressions. For each value defined in an enum class, a corresponding
label is defined. A label is a handle to access the related value. Think of it as an indirect access. Consider the following example:

```EnumClassLabel.definition.hack no-auto-output
<<file:__EnableUnstableFeatures('enum_class_label')>>
// We are using int here for readability but it works for any type
enum class E : int {
  int A = 42;
  int B = 42;
}
```

This example defines two constants `E::A: HH\MemberOf<E, int>` and `E::B: HH\MemberOf<E, int>`. Enum class labels add more definitions to the mix:

- `E#A: HH\EnumClass\Label<E, int>` is the label to access `E::A`
- `E#B: HH\EnumClass\Label<E, int>` is the label to access `E::B`
- `E::nameOf` is a static method expecting a label and returning its string representation: `E::nameOf(E#A) = "A"`
- `E::valueOf` is a static method expecting a label and returning its value: `E::valueOf(E#A) = E::A`

So we can rewrite the earlier example in a more resilient way:
```EnumClassLabel.example.achk no-auto-output
function full_print(HH\EnumClass\Label<E, int> $label) : void {
  echo E::nameOf($label) . " ";
  echo E::valueOf($label) . "\n";
}

function partial_print(HH\MemberOf<E, int> $value) : void {
  echo $value . "\n";
}
```
Now, `full_print(E#A)` will echo `A 42` and `full_print(E#B)` will echo `B 42`.

## Full v. Short Labels

We refer to labels like `E#A` as *fully qualified* labels: the programmer wrote the full enum class name. However there are some situations where Hack can infer
this part, and we can save the programmer that bit. For example, the previous calls could be written as `full_print(#A)` and `full_print(#B)`, leaving `E` implicit.
This is only allowed when there is enough type information to infer the right enum class name. For example, `$x = #A` is not allowed and will result in a type error.

### Special case of function calls

When the first argument of a function is a label, we provide an alternative notation to call it. This was done to reflect some generated code patterns this feature helped removed:
```EnumClassLabel.alt.hack no-auto-output
function set<T>(HH\EnumClass\Label<E, T> $label, T $data) : void {
  // setting $data into some storage using $label as a key
}

// all these calls are equivalent
function all_the_same(): void {
  set(E#A, 42);
  set(#A, 42);
  set#A(42);
}
```

As you can see, the short name can be written *before* the opening parenthesis of the function call. This only works for a single label argument, which must be the first one.

## Known corner cases

### The `#` character is no longer a one line comment
This feature relies on the fact that Hack and HHVM no longer consider the character `#` as a one line comment. Please use `//` for such purpose.

### Labels and values cannot be exchanged
If a method is expecting a label, one cannot pass in a value, and vice versa: `full_print(E::A)` will result in a type error and so will `partial_print(E#A)`.

### `MemberOf` is covariant, `Label` is invariant
A label should be considered as a way to attach a type to a binding. Therefore it is invariant: `E#A` is not of type `HH\EnumClass\Label<E, arraykey>`.
This can be misleading at first, because `HH\MemberOf` is invariant (it is data after all): `E::A` is of type `HH\MemberOf<E, arraykey>`.
