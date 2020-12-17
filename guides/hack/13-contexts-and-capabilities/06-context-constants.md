## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

Classes and interfaces may define context constants:

```
class WithConstant {
  const ctx C = [io];
}
```

They may be abstract,

```
interface IWithConstant {
  abstract const ctx C;
}
```

may have one or more bounds,

```
abstract class WithConstant {
  abstract const ctx COne super [defaults]; 
  abstract const ctx CMany super [defaults] as [io, rand]; 
}
```

and may have defaults, though only when abstract

```
interface IWithConstant {
  abstract const ctx C = [defaults];
  abstract const ctx CWithBound super [defaults] = [io];  
}
```

When inheriting a class containing a context constant with a default, the first non-abstract class that doesn’t define an implementation of that constant  gets the default synthesized for it.


One may define a member function whose context depends on the `this` type or the exact value of context constant.

```
class ClassWithConstant {
  const ctx C = [io];
}

abstract class AnotherClassWithConstant {
  abstract const ctx C;
  abstract public function usesC()[this::C, ClassWithConstant::C]: void;
}
```

One may define a function whose context depends on the dynamic context constant of one or more passed in arguments.

```
function uses_const_ctx(SomeClassWithConstant $t)[$t::C]: void {
  $t->usesC();
}
```

One may reference the dependent context constant of a argument in later arguments as well as in the return type.
```
function uses_const_ctx_more(
  SomeClassWithConstant $t,
  (function()[$t::C]: void) $f
)[$t::C]: (function()[$t::C]: void) {
  $f();
  $t->usesC();
  return $f;
}
```