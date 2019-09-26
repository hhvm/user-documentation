The simple-assignment operator `=` assigns the value of the right-hand operand to the left-hand operand.  For example:

```Hack
$a = 10
```

This form is commonly used in expression statements or as the first part of a `for` loop's controlling expressions.  This
operator involves a side-effect, that of assigning the value to `$a`.  And being a non-void expression, it also has a value,
in this case, 10. However, that value is not used, so it is discarded.  However, consider the following:

```Hack
$a = $b = 10    // equivalent to $a = ($b = 10)
```

As indicated by the comment, this operator is right-associative, so 10 is first assigned to `$b`, whose value is assigned to `$a`,
whose value is *not* used, so it is discarded.

We can assign to array elements, as follows:

```Hack
$v = dict[0 => 10, 1 => 20, 2 => 30];
$v[1] = 22;     // change the value of the element with int key 1
$v[-10] = 19;   // insert a new element with int key -10
```

For a dict, if the location designated by the left-hand operand is a non-existent array element, a new element is inserted with the
designated key and with a value being that of the right-hand operand. (For a vec, a new element can only be added to the right-hand end.)

We can assign to the elements of a string, as follows:

```Hack
$s = "red";
$s[1] = "X";    // OK; "e" -> "X"
$s[5] = "Z";    // extends string with "Z", padding with spaces in [3]-[4]

$s = "red";
$s[0] = "DEF";  // "r" -> "D"; only 1 char changed; "EF" ignored
$s[0] = "";     // "D" -> "\0"
```

The left-most single character from the right-hand operand is stored at the designated location; all other characters in the right-hand
operand string are ignored.  If the designated location is beyond the end of the destination string, that string is extended to the new
length with spaces (U+0020) added as padding beyond the old end and before the newly added character. If the right-hand operand is an
empty string, the null character \\0 (U+0000) is stored.

A *compound-assignment* operator has the form *op*`=` and is a short-hand notation for situations in which we wish to operate on the
value of a variable and to store the resort back in that variable.  For example:

```Hack
$v = 10;
$v += 20;     // $v = 30
$v -= 5;      // $v = 25
$v .= 123.45; // $v = "25123.45"
```

The expression `$v += 20` is equivalent to `$v = $v + 20`. Likewise for `$v -= 5` and `$v = $v - 5`, and `$v .= 123.45` and
`$v = $v . 123.45`.  However, consider the following:

```Hack
$list[$i++] += 10;
```

When the left-hand expression contains a side-effect, that side-effect is performed only once.

The complete set of compound-assignment operators is: `**=`, `*=`, `/=`, `%=`, `+=`, `-=`, `.=`, `<<=`, `>>=`, `&=`, `^=`, `|=`, and
[`??=`](https://docs.hhvm.com/hack/expressions-and-operators/coalesce#coalescing-assignment-operator).
