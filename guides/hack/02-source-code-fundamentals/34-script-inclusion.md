When creating large applications or building component libraries, it is useful to be able to break up the source code into small,
manageable pieces each of which performs some specific task, and which can be shared somehow, and tested, maintained, and
deployed individually. For example, a programmer might define a series of useful constants and use them in numerous and
possibly unrelated applications. Likewise, a set of class definitions can be shared among numerous applications needing to create objects of those types.

An *include file* is a script that is suitable for *inclusion* by another script. The script doing the including is
the *including file*, while the one being included is the *included file*. A script can be either an including file or
an included file, both, or neither.

It is important to understand that unlike the C/C++ (or similar) preprocessor, script inclusion in Hack is *not* a text
substitution process. That is, the contents of an included file are not treated as if they directly replaced the inclusion
operation source in the including file.

The name used to specify an include file may contain an absolute or relative path. In the latter case, an implementation may
use the configuration directive [`include_path`](http://docs.hhvm.com/manual/en/ini.core.php#ini.include-path) to resolve the
include file's location.

Variables defined in an included file take on the scope of the source line on which the inclusion occurs in the including file.
However, functions and classes defined in the included file are given global scope.

The library function [`get_included_files`](http://www.php.net/get_included_files) provides the names of all files included or required.

The `require` directive involves `require` followed by a filename. For example:

```Hack
require 'Point.php';
```

The filename must be a string that designates a file that exists, is accessible, and whose format is suitable for inclusion (that is, starts with a [Hack start-tag](program-structure.md)). If the designated file is not accessible, execution is terminated.

The `require_once` directive is like `require` except that in the case of `require_once`, the include file is included
once only during program execution.

Consider the following examples:

@@ script-inclusion-examples/Point.php @@

@@ script-inclusion-examples/Circle.php @@

@@ script-inclusion-examples/require-once.php @@
