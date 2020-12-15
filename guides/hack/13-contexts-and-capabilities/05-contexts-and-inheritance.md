## WARNING WARNING WARNING

This section is under active development and represents an unreleased feature

## Back to your regularly scheduled docs

TODO

Semantically, capabilities work as if they were required parameters to functions, and are thus contravariant. This means that, for example, a closure that requires a [rand] or [] (pure) context may be passed where the expected type is a function that requires [rand, io]. (The converse is disallowed because that would mean giving an additional capability for randomness out of thin air.)

The errors then fall out by normal subtyping rules by internally treating permissions as (implicit) arguments of a function/method.

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
In the above, the contexts on the methods in Parent and Child are required for Mid to typecheck successfully. Note also that maybePure in Parent need not be the pure context, and that maybeRand in Child need not be rand.

Capability subtyping
In reality, there may also exist a subtyping relationship between capabilities; suppose that a new capability FileInput is defined. Since reading from a file does not preclude one from reading a special file such as /dev/random on a UNIX-like system, the semantic model should conservatively assume that a function with capability FileInput must also have the Rand capability. Therefore, FileInput must be a subtype (subcapability) of Rand.

This has an important consequence that falls out by design: whenever some capability B that is subtype of capability A is available (in scope), any function (or operation) that requires A can be called (or performed, respectively).