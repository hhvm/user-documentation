In order to effectively use callables in Hack, there are some special functions that are part of the Hack library in order for the typechecker to correctly handle callables that are instance methods, static methods and functions.

These functions signal to the typechecker to look up the appropriate parameter and return types of the function/method, and the typechecker treats the call to them as if they return a callable of the appropriate type.

## `fun()`

In order to use a named function as a callable, you must call `fun()`, passing in the string name of the function that you want to use as the callback.

```
fun('name_of_function');
```

*Note*: If your code is in a namespace, then the fully qualified namespace to the named function must be used in the single quoted literal string.

## `inst_meth()`

In order to use an instance method as a callable, you must call `inst_meth()`, passing in the instance of the class that contains the method and the string name of the function that you want to use as the callback.

```
inst_meth($instance, 'name_of_instance_method');
```

*Note*: You cannot use `private` instance methods as a callback.

### `meth_caller()`

`meth_caller()` is similar to `inst_meth()` except that you don't need an instance of the class to call the instance method on the class. Like [`class_meth`](#class_meth) below, you pass the class name and then *instance* method to call.

```
class_meth(class_name::class, 'name_of_instance_method');
class_meth('class_name', 'name_of_instance_method');
```

*Note*: You cannot use `private` static methods as a callback.

*Note*: If your code is in a namespace, then the fully qualified namespace to the class must be used in the single quoted literal string for the class name.

*Note*: `meth_caller()` currently only works on methods with **zero** parameters.

## `class_meth()`

In order to use a static method as a callable, you must call `static_meth()`, passing in a class that contains the static method (or the string name of the class) and the string name of the function that you want to use as the callback.

```
class_meth(class_name::class, 'name_of_static_method');
class_meth('class_name', 'name_of_static_method');
```

*Note*: You cannot use `private` static methods as a callback.

*Note*: If your code is in a namespace, then the fully qualified namespace to the class must be used in the single quoted literal string for the class name.
