In command-line (cli) mode, you run the `hhvm` binary from the command-line, execute the script and then exit HHVM immediately when the script completes.

Here is an example of how to run a script in HHVM cli mode. Take the following PHP script:

@@ command-line-examples/fib.php @@

At the command-line, you would execute the script as follows:

```
% hhvm /path/to/fib.php 10
```

You specify the `hhvm` binary, the path to `fib.php` and an argument to the script (arguments to scripts do not exist in all cases, of course).

```
The 10 number in fibonacci is: 55
```
