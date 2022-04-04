A problem encountered when managing large projects is that of avoiding the use of the same name in the same scope for different
purposes. This is especially problematic in a language that supports modular design and component libraries.  This problem is
addressed by namespaces.

A *namespace* is a container for a set of (typically related) definitions of classes, interfaces, traits, functions, and constants.

A namespace may have *sub-namespaces*, where a sub-namespace name shares a common prefix with another namespace. For example, the
namespace `Graphics` might have sub-namespaces `Graphics\TwoD` and `Graphics\ThreeD`, for two- and three-dimensional facilities,
respectively. Apart from their common prefix, a namespace and its sub-namespaces have no special relationship. The namespace
whose prefix is part of a sub-namespace need not actually exist for the sub-namespace to exist. That is, `NS1\Sub` can exist
without `NS1`.

In the absence of any namespace definition, the names of subsequent classes, interfaces, traits, functions, and constants are in
the *default namespace*, which has no name, per se.

The names of some types (such as `Exception`), constants, and library functions (such as `sqrt`) are defined outside any namespace.
To refer unambiguously to such names, one can prefix them with a backslash (`\`), as in `\Exception` and `\sqrt`. The names of
the standard types that are introduced with Hack belong to namespace `HH`.

The namespaces `HH`, `PHP`, `php`, and sub-namespaces beginning with those prefixes are reserved for use by Hack.

The pre-defined constant `__NAMESPACE__` contains the name of the current namespace.

When the same namespace is defined in multiple scripts, and those scripts are combined into the same program, the namespace
is considered the merger of its individual contributions.

A namespace directive has two forms.  For example, Script1.php uses the semi-colon form:

```Hack
namespace NS1;
...				// __NAMESPACE__ is "NS1"
namespace NS3\Sub1;
...				// __NAMESPACE__ is "NS3\Sub1"
```

In this form, the given namespace extends until the end of the script, or until the lexically next namespace definition,
whichever comes first.

In the following example, an alternate, brace-delimited form is used:

```Hack
namespace NS1
{
...                   // __NAMESPACE__ is "NS1"
}
namespace
{
...                   // __NAMESPACE__ is ""
}
namespace NS3\Sub1;
{
...                   // __NAMESPACE__ is "NS3\Sub1"
}
```

In this case, the namespace extends from the opening brace to the closing brace.

A namespace can import&mdash;that is, get access to&mdash;one or more names into a scope, optionally giving them each an alias.
Each of those names may designate a namespace, a sub-namespace, a class, an interface, or a trait.  For example:

```namespaces.inc.hack no-auto-output
namespace NS1 {
  const int CON1 = 100;
  function f(): void {
    echo "In ".__FUNCTION__."\n";
  }

  class C {
    const int C_CON = 200;
    public function f(): void {
      echo "In ".__NAMESPACE__."...".__METHOD__."\n";
    }
  }

  interface I {
    const int I_CON = 300;
  }

  trait T {
    public function f(): void {
      echo "In ".__TRAIT__."...".__NAMESPACE__."...".__METHOD__."\n";
    }
  }
}

namespace NS2 {
  use type NS1\{C, I, T};

  class D extends C implements I {
    use T;
  }

  function f(): void {
    $d = new D();
    echo "CON1 = ".\NS1\CON1."\n";
    \NS1\f();
  }
}
```

```using-namespaces.hack
namespace Hack\UserDocumentation\Fundamentals\Namespaces\Examples\Main;

<<__EntryPoint>>
function main(): void {
  \NS2\f();
}
```

When importing many member names from a given namespace, we can use a group form of `use`.  For example:

```Hack
use NS1\{C, I, T};
```

instead of

```Hack
use NS1\C, NS1\I, NS1\T;
```
