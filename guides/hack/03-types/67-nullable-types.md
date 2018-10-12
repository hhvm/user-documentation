Consider an application that processes results from a questionnaire. To store the answer to a Yes/No question, it seems reasonable to use a `bool` type. 
However, what if no answer was given (perhaps it simply is missing, or the question was deemed “not applicable”). In such cases, it can be useful to 
have a special value to represent *this is not a real answer* or *the answer is unknown*. In Hack, we can solve this by using a nullable `bool` type, 
written as `?bool`. Such a type permits all the values of type `bool` plus `null` (the null literal value).

Likewise, an application that processes employee information might contain date-related fields like date-of-birth, date-of-hire, and date-of-last-review, 
each represented by an instance of some user-defined type `Date`. To allow for such information to be unknown/not available, we could use the nullable 
type `?Date`.

A variable of type `mixed` can represent the values of any other type, including any nullable type, which makes `mixed` a nullable type. (However, 
there is no such type `?mixed`.)

Note that `?void` is *not* permitted.

```Hack
?bool $nbool;                        // nullable bool
class Date { ... }
?Date $nDate;                        // nullable class
?(int, ?string, ?(bool, int)) $nTup; // nullable tuple whose
    // second element has type "nullable string", and whose third element
    // has type "nullable tuple of bool and int"
```

Consider the following function declaration from the math library:

```Hack
function log(num $arg, ?num $base = null): float;
```

As shown, the log-to-any-base function `log` takes a `num` and a nullable-of-`num`, and returns a `float`. The second argument is optional, 
and if none is provided when the function is called, `null` is used instead. This situation is tested for inside `log`, which then takes some 
appropriate default action.

The library function `trim` removes leading and trailing whitespace from a given string producing a new stripped-down string. By default, 
whitespace includes space, horizontal tab, newline, carriage return, zero-valued byte, and vertical tab. However, the set of characters to 
be stripped out can be specified using the optional second argument, whose type is a nullable `string`. This allows `null` to be passed 
explicitly (or implicitly of the second argument is omitted) to indicate the default behavior should be used:

```Hack
function trim(string $string, ?string $char_mask = null): string;
```
