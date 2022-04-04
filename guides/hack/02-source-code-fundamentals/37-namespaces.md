A ***namespace*** is a container for a set of (typically related) definitions of classes, interfaces, traits, functions, and constants.

When the same namespace is defined in multiple scripts, and those scripts are combined into the same program, the namespace
is the union of all individual components.

The predefined constant `__NAMESPACE__` contains the name of the current namespace.

## The Root Namespace
In the absence of any namespace definition, the names of subsequent classes, interfaces, traits, functions, and constants are in
the ***root namespace***, which is not named.

## Sub-Namespaces
A namespace can have ***sub-namespaces***, where a sub-namespace name shares a common prefix with another namespace. 

For example, the namespace `Graphics` can have sub-namespaces `Graphics\TwoD` and `Graphics\ThreeD`, for two- and three-dimensional facilities,
respectively. 

Apart from their common prefix, a namespace and its sub-namespaces have no special relationship. For example, `NS1\Sub` can exist without `NS1`. A named top-level namespace does not need to exist for a sub-namespace to exist.

## Reserved Namespaces
The namespaces `HH`, `PHP`, `php`, and sub-namespaces beginning with those prefixes are reserved for use by Hack.

### The `HH` Namespace
Built-in types like `vec`, `keyset`, `dict`, and `shape` exist in the `HH` namespace (e.g. `HH\Lib\Vec`).

Other types, such as `Exception`, and constants, and library functions (such as `sqrt`) are in `HH` too. Prefix a backslash (`\`) to refer to these types or functions; for example: `\Exception`, `\sqrt`.

### XHP and the `HTML` Namespace
As of HHVM 4.73 and XHP-Lib v4, standard XHP elements like `<p>` are defined in `Facebook\XHP\HTML` (for this example, specifically `Facebook\XHP\p`).

For more information, see [XHP Namespace Support](/hack/XHP/setup#namespace-support).

## Defining a Namespace
Namespaces can be defined with semicolons (`;`) or brace delimiters (`{ ... }`).

With semicolons, a namespace extends until the end of the script, or until the next namespace definition, whichever is first.

```Hack
namespace NS1;
...				// __NAMESPACE__ is "NS1"
namespace NS3\Sub1;
...				// __NAMESPACE__ is "NS3\Sub1"
```

With brace delimiters, a namespace extends from the opening brace to the closing brace.

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
## Importing from other Namespaces
With the `use` keyword, a namespace can import one or more member names into a scope, optionally giving them each an alias.

When importing many names, use `{ ... }`.

```Hack
use NS1\{C, I, T}; // instead of `NS1\C, NS1\I, NS1\T`
```

Imported names can designate a namespace, a sub-namespace, a class, an interface, or a trait, as shown in the following example:

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