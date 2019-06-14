A `throw` statement throws an exception immediately and unconditionally.  Control never reaches the statement immediately
following the throw. See the [try statement](try.md) for more details of throwing and catching exceptions.  For example:

```Hack
if ($denominator === 0) throw new HH\Lib\Math\DivisionByZeroException();
class MyException extends \Exception { ... }
throw new MyException;
```

The type of the exception thrown must be `\Exception` or a subclass of that class.
