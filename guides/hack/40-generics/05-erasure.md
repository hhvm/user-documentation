# Type Erasure

Support for generics is only at the typechecker level; they do not exist at runtime. Generic type parameters and arguments and stripped out (i.e., erased) before execution, which severely limits what you can do with them. In fact, the only thing you can do with type parameter name is to use it in a **type annotation**. You can't create a new instance of a type parameter T using `new` (e.g., `new T()`), cast to it (e.g., `(T) $value`), etc.
