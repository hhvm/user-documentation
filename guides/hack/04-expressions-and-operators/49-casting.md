Occasionally, it is useful to be able to have values of different types in the same expression.  (Certainly, it's common to want to mix 
integers and floating-point values.)  However, for the most part, Hack does *not* allow implicit conversion of one type to another.  Instead, 
it requires an explicit conversion, which uses the cast operator whose general form is `(` *cast-type* `)` *value*.  For example:

```Hack
$i = true;
$result = 12.9 * (float)$i;  // float + bool -> float
```

Here, the cast operator creates an unnamed value that is the `float` equivalent of `true` (that is, 1.0); `$i` itself is unchanged.

A cast can result in a loss of information.  For example:

```Hack
$pi = 3.1415926;
$result = (int)$pi;   // $result takes on the int value 3
```

The only type-casts permitted are, to types [`bool`](../types/type-conversion.md#conversion-to-bool), 
[`int`](../types/type-conversion.md#conversion-to-int), [`float`](../types/type-conversion.md#conversion-to-float), 
and [`string`](../types/type-conversion.md#conversion-to-string).
