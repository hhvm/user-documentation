Hack has three comment syntaxes.

@@ comments-examples/show-comment-styles.php @@

Multi line comments start with `/*` and end with `*/`. Comments
starting `/**` are also used for documentation.

Single-line comments start with `//` or `#`, and end with a newline.

A number of special comments are recognized; they are:
* [`// FALLTHROUGH`](../statements/switch.md)
* [`// strict` or `// partial`](program-structure.md)
* `/* HH_FIXME[`*nnnn*`] */` or `/* HH_IGNORE_ERROR[`*nnnn*`] */`, where *nnnn*
  is the type checker error number that is to be ignored.
