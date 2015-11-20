Attributes can be placed on any reflectable piece of code. These include:

- Functions
- Methods
- Classes
- Interfaces
- Traits

Attributes are enclosed within `<<` and `>>`. Multiple attributes can be enclosed within the same set of brackets. And each attribute has a key and an optional set of comma-separated values. 

## Official Syntax

```
<<key[(value 1,...,value N)][..., key[(value 1,...,value N)]]>>
```

## Examples of Syntax

```
<<NoValuesAttribute>>
function foo() {}
```

```
<<OneValueAttribute('Hello')>>
class A {}
```

```
<<FirstAttribute('Good', 'Afternoon'), SecondAttribute, ThirdAttribute('2')>>
trait B {}
```

## Special Attributes

Attributes starting with `__` are [special attributes](special.md) reserved by the typechecker and HHVM. Custom attributes cannot start with `__`.

## Attribute Access

You access an attribute using `getAttribute()` on `ReflectionClass`, `ReflectionFunction`, etc. Just pass the key to the attribute to `getAttribute()` to receive its array of values.
