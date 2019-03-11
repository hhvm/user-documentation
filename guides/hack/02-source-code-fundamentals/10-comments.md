There are two forms of comments: delimited and single-line.  For example:

@@ comments-examples/show-comment-styles.php @@

A *delimited comment* starts with `/*` and ends with `*/`, and may span source lines. It may contain any characters except 
the sequence `*/`. A delimited comment may occur in *any* place in a script in which white space may occur. For example:

```Hack
/*...*/$c/*...*/=/*...*/567/*...*/;/*...*/
```

is interpreted as 

```Hack
$c=567;
```

and

```Hack
$k = $i+++/*...*/++$j;
```

is interpreted as

```Hack
$k = $i+++ ++$j;
```

A *single-line comment* starts with `//` or `#`, and ends with a new line, which is not part of the comment.

A number of special comments are recognized; they are:
* [`// FALLTHROUGH`](../statements/switch.md)
* [`// strict`](program-structure.md)
* `/* HH_IGNORE_ERROR[`*nnn*`] */`, where *nnn* is the compiler error number that is to be ignored.
