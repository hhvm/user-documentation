# Enums

If you are familiar with enums (enumerations) in languages like C#, C++ or Java, then Hack enums will make you feel right at home. Enums encapsulate a group of related constants, unlike just using global or class constants. Enums actually create a new type, annotatable by name. 

**NOTE**: At this point, Hack only supports `int` and `string` enums.

## Syntax

The syntax of an enum is relatively straightforward, with a similar feel to other languages supporting enums.

```
enum <NameOfEnum> : <string | int> {
  <Member1> = <value>;
  <Member2> = <value>;
  :
  :
  <MemberN> = <value>;
} 
```

The name of the enum has to be namespace unique, and members of the enum must be uniquely named too.

@@ introduction-examples/simple.php @@

## Enum Member Values

The values of enum members must match the type of the enum. If your enum is marked as being an `int`, enum, then the member values must be `int`. Also, the values must be able to be statically evaluated. In other words, no variables, etc. can be used as part of an enum member value.

To access a member value, you follow the similar syntax as class constants

```
<NameOfEnum>::<MemberN>
```

@@ introduction-examples/member-values.php @@

**NOTE**: There is no notion of sequential, implicit values to enum members. For example, if you set the first member to `0`, the next member doesn't, by default, have the value of `1`. Each enum member must have an explicit value assigned to it. 

## Casting to Underlying Type

While enums have underlying types, they are not interchangeable. The enum is a distinct type. And like any other types, you cannot, for example, pass an `int` to a function expecting an enum, or an enum value to a function expecting a `string`. 

However, you can use simple casting to convert a member value of an enum to its underlying type, and you can use Hack's special [enum functions](functions.md) [`assert()`](functions.md#assert) and [`coerce()`](functions.md#coerce) to convert from an underlying type to an enum type.

**NOTE**: You can use some language constructs like `echo` without casting to the underlying type.

@@ introduction-examples/casting.php @@

### Implicit Casting

By using the `as` constraint operator, you can make it so casting to the underlying type is implicit.

@@ introduction-examples/implicit-casting.php @@
