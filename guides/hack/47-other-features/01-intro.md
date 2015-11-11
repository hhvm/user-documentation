# Other Hack Features

In addition to the primary topics covered in this user guide, Hack has other noteworthy features that deserve attention. 

* [Constructor parameter promotion](./constructor-parameter-promotion.md) allows you to reduce class property boilerplate in your code.
* [Trait and interface requirements](./trait-and-interface-requirements.md) allow you to restrict what classes can use a trait or implement an interface.
* [Enhanced autoloading](./autoloading.md) enhances the normal class autoloading process with the autoloading of Hack (and PHP) functions and constants, as well as Hack traits.
* [Variadic functions](./variadic-functions) allow functions to take a variable number of arguments. They are supported like PHP, but must be implicitly marked variadic, enhancing type safety and checking.
* [Placeholder Variable](./placeholder-variable) allows for variables of any type to be assigned to it with the agreement that the variable will not be use after assignment. A canonical example is iterating over key/value pairs where you don't care about the value. It is represented by `$_`.
