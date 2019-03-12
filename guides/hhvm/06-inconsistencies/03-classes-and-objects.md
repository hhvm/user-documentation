There are a few inconsistencies when it comes how objects are handled internally in HHVM and PHP, affecting things like error handling and exceptions.

## Exceptions thrown from destructors

Under HHVM, PHP exceptions thrown from destructors will be swallowed while logging an error. Effectively, there is a `try/catch` enclosing the body of the `__destruct` method. These exceptions are catchable under the PHP engine outside of the `__destruct` method.

Fatals thrown from destructors will log an error, and prevent further PHP code from executing as the fatal propagates. This includes other `__destruct` methods.

## Exceptions thrown from __toString()

PHP5 does not allow exceptions to be thrown from `__toString()`. HHVM does.

@@ classes-and-objects-examples/toString-exception.php @@

Difference: [https://3v4l.org/XHDP8](https://3v4l.org/XHDP8)

## __call/__callStatic() handling

Take the following example:

@@ classes-and-objects-examples/call.php @@

Under HHVM, both checking and invocation of `__call()` happen on class G. In PHP, you will get a fatal error.

Difference: [https://3v4l.org/t9pba](https://3v4l.org/t9pba)

## Object internal cursors

Under PHP5, objects have an internal cursor (similar to the array internal cursor) that can be used to iterate over the object's properties. Under HHVM, objects do not have internal cursors, and the `next()`, `prev()`, `current()`, `key()`, `reset()`, `end()`, and `each()` builtin functions do not support objects.

## Suppressing errors for parameters to default constructors

If a class doesn't define a constructor then you construct that object passing whatever you want, including things that would fatal the runtime. HHVM doesn't allow this, and will always evaluate the arguments whether the class has a constructor or not.

@@ classes-and-objects-examples/default-constructor-param.php @@

Difference: [https://3v4l.org/FDpj0](https://3v4l.org/FDpj0)
