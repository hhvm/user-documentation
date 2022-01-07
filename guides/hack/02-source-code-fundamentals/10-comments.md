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

Multi-line comments start with `/*` and end with `*/`. Comments
starting `/**` are also used for documentation.

Single-line comments start with `//` and end with a newline. 

`#` is not a valid comment character, as it is used to represent an [Enum Class Label](/hack/built-in-types/enum-class-label).

A number of special comments are recognized; they are:

* `// FALLTHROUGH` in [switch statements](/hack/statements/switch)
* `// strict` and `// partial` in [headers](/hack/source-code-fundamentals/program-structure)
* `/* HH_FIXME[1234] */` or `/* HH_IGNORE_ERROR[1234] */`, which
  suppresses typechecker error reporting for error 1234.