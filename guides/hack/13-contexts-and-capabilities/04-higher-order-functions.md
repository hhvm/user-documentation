## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

TODO

Additionally, the context list may appear in a function type:

function has_fn_args(
  (function (): void) $no_list,
  (function ()[io, rand]: void) $list,
  (function ()[]: void) $empty_list,
): void {...}


One may define a higher order function whose context depends on the dynamic context of one or more passed in function arguments.

function has_dependent_fn_arg(
  (function()[_]: void) $f,
)[rand, ctx $f]: void {... $f(); ...}

function has_dependent_fn_args(
  (function()[_]: void) $f,
  (function()[_]: void) $f2,
)[rand, ctx $f, ctx $f2]: void {... $f(); ... $f2(); ...}
One may reference the dependent context of a function argument in later arguments as well as in the return type.

function has_double_dependent_fn_arg(
  (function()[_]: void) $f1,
  (function()[ctx $f1]: void) $f2,
)[rand, ctx $f1]: void {$f1(); $f2(); }

function has_dependent_return(
  (function()[_]: void) $f,
)[rand, ctx $f]: (function()[ctx $f]: void) {
  $f();
  return $f;
}
Attempting to use the dependent context of an argument before it is defined will result in an error about using an undefined variable.

Note that the special _ placeholder context may only be used on function arguments.

// The following are all disallowed
type A = (function()[_]: void);
newtype A = (function()[_]: void);

Class Example {
  public (function()[_]: void) $f;
  public static (function()[_]: void) $f2;
}
function example(): (function()[_]: void) {}


SEMANTICS


Higher-order functions are typically used for generalization purposes, with common examples including standard map and filter functions. For these functions, a common pattern is to generalize over the inputs and/or outputs of their function-typed arguments. It is imperative that the addition of contexts does not remove this generalizability while maintaining simplicity of their definitions.

Consider the following higher-order function declaration and calling functions. In order to maintain generality, safety, and backwards compatibility, the end result needs to be that good_caller and nocontext_caller should typecheck while bad_caller should not. We solve this problem via the use of dependent contexts, defined above.

function callee(
  (function()[_]: void) $f,
)[rand, ctx $f]: void {... $f(); ...}

function good_caller()[io, rand]: void {
  // pass pure closure
  callee(()[] ==> {...}); // callee is {Rand}

  // pass {IO} closure
  callee(()[io] ==> echo "output"); // callee is {Rand, IO}
  // pass {IO, Rand} closure
  callee(() ==> echo "output"); // callee is {Rand, IO}
  callee(() ==> {...}); // callee is {Rand, IO}
}

function bad_caller()[]: void {
  // pass {} closure but tries to do IO
  callee(()[] ==> echo "output"); // // C is {} -> callee is {Rand}
  // pass {} closure
  callee(() ==> {...}); // C is {} -> callee is {Rand}
}

function nocontext_caller(): void {
  // this closure requires the default context
  callee(() ==> {...}); // callee is {Rand, Throws<mixed>, IO}
}
Note that, logically, this suggests and requires that all other statements within callee require only the Rand capability, as the actual C passed cannot be depended upon to be any specific capability (and can in fact be the empty set of capabilities).

A potentially more compelling example is the Vec\map function in the Hack Standard Library.

function map<Tv1, Tv2>(
  Traversable<Tv1> $traversable,
  (function(Tv1)[_]: Tv2) $value_func,
)[ctx $value_func]: vec<Tv2> { ... }