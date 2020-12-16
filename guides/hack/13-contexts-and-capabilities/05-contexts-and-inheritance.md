## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

Capabilities are contravariant.

This implies that a closure that requires a set of capabilities S<sub>a</sub> may be passed where the expected type is a function that requires S<sub>b</sub> as long as S<sub>a</sub> ⊆ S<sub>b</sub>.

```
// Here the default context includes at least {Rand, IO}
function requires_rand_io_arg((function()[rand, io]: void) $f): void {
  $f();
}

function caller(): void {
  // passing a function that requires fewer capabilities
  requires_rand_io_arg(()[rand] ==> {...}); 
  // passing a function that requires no capabilities 
  requires_rand_io_arg(()[] ==> {...});  
}
```

Additionally, this has the standard implication on inheritance hierarchies. Note that if S<sub>a</sub> ⊆ S<sub>b</sub> it is the case that S<sub>b</sub> is a subtype of S<sub>a</sub>.

For the following, assume the default set contains {IO, Rand, Throws<mixed>}.

```
class Parent {
  public function maybeRand()[rand]: void {...} // {Rand}
  public function maybePure(): void {...} // {Throws<mixed>, IO, Rand}
}

class Mid extends Parent {
  public function maybeRand()[rand]: void {...} // {Rand} -> fine {Rand} ⊆ {Rand}
  public function maybePure()[io]: void {...} // {IO} -> fine {IO} ⊆ {Throws<mixed>, IO, Rand}
}

class Child extends Mid {
  public function maybeRand()[]: void {...} // {} -> fine {} ⊆ {Rand}
  public function maybePure()[]: void {...} // {} -> fine {} ⊆ {IO}
}
```

### Capability subtyping

In reality, there may also exist a subtyping relationship between capabilities. Thus, whenever some capability B that is subtype of capability A is available, any function or operation that requires A may be called or performed, respectively. This works identically to standard type subtyping.

For the following, assume that the following contexts and capabilities exist: Rand, ReadFile <: Rand, rand: {Rand}, readfile: {Readfile}

```
function requires_rand()[rand]: void {...}

function has_readfile()[readfile]: void {
  requires_rand(); fine {readfile} ⊆ {Rand} since readfile <: rand
}
```