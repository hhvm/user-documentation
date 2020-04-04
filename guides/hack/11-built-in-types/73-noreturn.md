A function that never returns a value can be annotated with the
`noreturn` type. A `noreturn` function either loops forever, throws an
an error, or calls another `noreturn` function.

``` Hack
function something_went_wrong(): noreturn {
  throw new Exception('something went wrong');
}
```

`exit` is an example of a library function with a `noreturn` type.
