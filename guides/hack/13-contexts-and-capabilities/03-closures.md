## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

As with standard functions, closures may optionally choose to list one or more contexts. Note that the outer function may or may not have its own context list. Lambdas wishing to specify a list of contexts must include a (possibly empty) parenthesized argument list.

```
function some_function(): void {
  $no_list = () ==> {...};
  $single = ()[C] ==> {...};
  $multiple = ()[C1, C2, ..., Cn] ==> {...};
  $with_types = ()[C]: void ==> {...};
  // legacy functions work too
  $legacy = function()[C]: void {};

  // does not parse
  $x[C] ==> {}
}
```

By default, closures require the same capabilities as the context in which they are created. Explicitly annotating the closure can be used to opt-out of this implicit behaviour. This is most useful when requiring the capabilities of the outer scope result in unnecessary restrictions, such as if the closure is returned rather than being invoked within the enclosing scope.

```
function foo()[io]: void { // scope has {IO}
  $callable1 = () ==> {...}; // requires {IO} - By far the most common usage
  $callable2 = ()[] ==> {...}; // does not require {IO}, requires {}
  $uncallable1 = ()[rand] ==> {...}; // does not require {IO}, requires {Rand}
  $uncallable2 = ()[defaults] ==> {...}; // does not require {IO}, requires the default set
}
```
Note that in the previous example, $uncallable1 cannot be called as foo cannot provide the required Rand capability. $callable2 is invocable because it requires strictly fewer capabilities than foo can provide.