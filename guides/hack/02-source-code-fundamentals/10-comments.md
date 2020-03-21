Hack has three comment syntaxes.

@@ comments-examples/show-comment-styles.php @@

Multi line comments start with `/*` and end with `*/`. Comments
starting `/**` are also used for documentation.

Single-line comments start with `//` or `#`, and end with a newline.

A number of special comments are recognized; they are:

* `// FALLTHROUGH` in [switch statements](../statements/switch.md)
* `// strict` and `// partial` in [headers](program-structure.md)
* `/* HH_FIXME[1234] */` or `/* HH_IGNORE_ERROR[1234] */`, which
  suppresses typechecker error reporting for error 1234.
