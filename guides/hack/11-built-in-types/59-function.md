The `function` type represents
[anonymous functions](/hack/functions/anonymous-functions)
as well as
[function references](/hack/functions/function-references).

The return type and the types of all parameters are part of the `function` type
signature, so the type checker will prevent passing down functions of
incompatible types.

```
function takes_int_function(
  (function(int): bool) $validator,
): void {}

$validate_number = (int $number): bool ==> $number < 100;
$validate_string = (string $str): bool ==> Str\length($str) > 3;

takes_int_function($validate_number);  // OK
takes_int_function($validate_string);  // error!
```

Note that to prevent ambiguity, all `function` type declarations have to be
wrapped in parentheses.

[Variadic functions](/hack/functions/introduction#variadic-functions) and
[generic types](/hack/generics/some-basics) are also supported.

```
function takes_various_functions<T>(
  (function(): void) $no_params_no_return,
  (function(int, string): bool) $has_params,
  (function(float, int...): string) $has_varargs,
  (function(string, T): vec<T>) $has_generics,
): void {}
```
