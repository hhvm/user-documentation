## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

TODO

In addition to standard and type constants, classes may define context constants:

class WithConstant {
  const ctx C = [io];
  ...
}
Context constants may be abstract, and possibly have a default. If they are abstract, they may additionally contain one or both of the as and super constraints.

interface WithAbstractConstants<T> {
  abstract const ctx C1; // bare abstract
  abstract const ctx C2 = [io]; // abstract with default
  abstract const ctx C3 as [io, rand]; // abstract with bound
  abstract const ctx C4 super [io, rand] = [io]; // abstract with bound and default

  // Disallowed: Concrete with bound.
  const ctx C5 super [io, rand] = [io];
}
Context constants are accessed off of function arguments in a similar manner to function-type arguments. The same restrictions about use-before-define apply.

function type_const(SomeClassWithConstant $t)[$t::C]: void { $t->f(); }
Context constants are accessed off this or a specific type directly within the contexts list:

public function access_directly()[this::C1, MySpecificType::C2]: T {...}
Context constants may not be referenced off of a dependent/nested type. Said another way, context constants may only have the form $arg::C, not $arg::T::C, etc. It is possible we will relax this restriction in a future version.

interface IHasCtx {
  abstract ctx C;
}

interface IHasConst {
  abstract const type TC as IHasCtx;
}

// Disallowed: nested type acces
function type_const(IHasConst $t)[$t::TC::C]: void {}

abstract class MyClass implements IHasConst {
  // Disallowed: also applies to dependent types of this
  public  function type_const()[this::TC::C]: void{}
}
For the sake of simplicity, this must be used in lieu of $this within the context list.


Background
It is not uncommon to want your API to accept an object implementing an interface and then invoke a method appearing on that interface. That is fine in the common case, wherein the context of that function within the hierarchy is invariant. However, it is possible for a hierarchy to exist for which it is difficult or impossible to guarantee that all implementations of a method have the same context. There are a good number of these situations within the Facebook codebase, but the easiest example is the Traversable hierarchy.

The following is an oversimplification of the hierarchy and methodology for how Traversables work in Hack. Do not consider this an actual reference to their inner workings. Consider a Traversable interface that defines a next function which gives you the next item and an isDone function that tells you if there are more elements.

interface Traversable<T> {
  public function next()[???]: T; // what do we put here?
  public function isDone()[]: bool; // always pure
}
The most common children of Traversable are the builtin Containers, with children like vec and Map. However, non-builtin objects are allowed to extend Traversable as well, creating arbitrarily traversable objects.

interfact Container<T> implements Traversable<T> {
  public function next()[]: T; // {}
}

final class CreateTenNumbers implements Traversable<int> {
  private int $nums = 0;
  private bool $done = false;
  public function isDone()[]: bool { return $this->done; } // {}
  public function next()[rand]: int { // {Rand}
    invariant(!$this->done, 'off the end');
    if ($this->nums++ === 10) { $this->done = true; }
    return rand_int();
  }
}
Now consider the following function:

function sum(Traversable<int> $nums)[]: int { // Has {}!!!
  $sum = 0;
  while(!$nums->isDone()) {
    // if $nums is CreateTenNumbers, this is unsafe!
    $sum += $nums->next(); // hmmmmm
  }
  return $sum;
}
This code should not typecheck! The sum function has no capabilities, but what are the capabily requirements of the call to next?

Solution
The solution to this problem is the capability constants described above; the idea simply being that the interface has an abstract capability list, usable on methods of the interface, and concretized by children. In our case, we would use such a capability constant to describe the next function:

interface Traversable<T> {
  abstract const ctx C;
  public function next()[this::C]: T;
  public function isDone()[]: T;
}

interface Container<T> implements Traversable<T> {
  const ctx C = [];
}

final class CreateTenNumbers implements Traversable<int> {
  ...
  const ctx C = [rand];
  public function next()[rand]: int { ... }
  ...
}

function sum(Traversable<int> $nums)[$nums::C]: int { ... }
In fact, the Vec\map function above would likely actually look something like this:

function map<Tv1, Tv2>(
  Traversable<Tv1> $traversable,
  (function(Tv1)[_]: Tv2) $value_func,
)[$traversable::C, ctx value_func]: vec<Tv2> { ... }
As with normal type constants, one cannot override a concrete capability constant.

Context Constant Defaults
As with normal type constants, we don’t want to force all children to specify the constant. Thus we expose abstract context constants with defaults.

abstract const ctx C = [defaults];
Here, the first non-abstract class that doesn’t define a concrete context for C gets [defaults] synthesized for it.

