A Hack program consists of one or more source files, each of which is formally known as a *script*. Each script *must* have the 
following general format:

```Hack
<?hh // strict
```

followed by one or more declarations of the following kind, in any order:

* alias declaration
* class
* enumerated type
* function
* inclusion directive
* interface
* namespace
* trait
* use

Consider the following script:

@@ program-structure-examples/hello-world.php @@

In this example, the start-up function is called `main`; however, that was an arbitrary choice of name; it could just as easily 
have been `run`, `do_it`, or `make_magic`. (What makes `main` the start-up function is the presence of the [attribute `__Entrypoint`](../attributes/predefined-attributes#__entrypoint).)

A Hack script can be processed in any one of a number of *modes*, of which `strict` is one. This mode is specified in a 
special single-line comment, on the first source line, as shown.  This tutorial only deals with strict mode.  (Check to see if 
your implementation supports modes other than `strict`.)

A script can import another script via [script inclusion](script-inclusion.md).
