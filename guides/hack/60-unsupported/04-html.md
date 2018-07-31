In PHP, it is not uncommon to see PHP and HTML intermixed in the same file. 

@@ html-examples/html-php.php @@

The above PHP code will run just fine in HHVM. At the command line, the output will be the raw HTML with the proper date included.

This is not supported in Hack - the file must start with `<?hh` (except for any shebang lines).

## Use XHP

If you really want to mix HTML-like elements with your Hack code, [XHP](../XHP/introduction.md) was made especially for that. And, it is typecheckable.
