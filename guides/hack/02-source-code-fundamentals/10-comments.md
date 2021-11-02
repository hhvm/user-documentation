Hack has three comment syntaxes.

```show-comment-styles.hack no-auto-output
// A single line comment.

/* A multi line comment.
 *
 */

/**
 * A doc comment starts with two asterisks.
 *
 * It summarises the purpose of a definition, such as a
 * function, class or method.
 */
function foo(): void {}
```

Multi line comments start with `/*` and end with `*/`. Comments
starting `/**` are also used for documentation.

Single-line comments start with `//` or `#`, and end with a newline.

A number of special comments are recognized; they are:

* `// FALLTHROUGH` in [switch statements](../statements/switch.md)
* `// strict` and `// partial` in [headers](program-structure.md)
* `/* HH_FIXME[1234] */` or `/* HH_IGNORE_ERROR[1234] */`, which
  suppresses typechecker error reporting for error 1234.
