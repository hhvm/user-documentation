The `new` operator allocates memory for an object that is an instance of the specified class.  The object is initialized by calling the 
class's [constructor](../classes/constructors.md) passing it the optional argument list, just like a function call. If the class has no 
constructor, the constructor that class inherits (if any) is used.  For example:

@@ new-examples/Point.php @@

The result is an object of the type specified.

The `new` operator may also be used to allocate memory for an instance of a [classname](../types/classname.md) type; for example:

```Hack
final class C { ... }
function f(classname<C> $clsname): void {
  $w = new $clsname();
  ...
}
```

Any one of the keywords `parent`, `self`, and `static` can be used between the `new` and the constructor call, as follows. From within a 
method, the use of `static` corresponds to the class in the inheritance context in which the method is called. The type of the object 
created by an expression of the form `new static` is [`this`](../types/this.md). See [$$](scope-resolution.md) for a discussion of `parent`, 
`self`, and `static` in this context.
