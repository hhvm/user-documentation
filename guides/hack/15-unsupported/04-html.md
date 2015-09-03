In PHP, it is not uncommon to see PHP and HTML intermixed in the same file. 

@@ html-examples/html-php.php @@

The above code will run just fine in HHVM. At the command line, the output will be the raw HTML with the proper date included.

## No Typechecking, Runtime Errors

The problem becomes when you try to replace `<?php` with `<?hh`. 

@@ html-examples/html-hack.php @@

And the problem is confusing. The typechecker will basically throw its hands up and 
give you *"No Errors!"*, no matter what you put after the `<?hh`, even in [strict mode](../17-typechecker/05-modes.md). That's great, right? Nope. The typechecker doesn't even understand this type of file and, on top of that, this code won't even run in HHVM. You will get a fatal error complaining that there is unknown content before the `<?hh` tag. 

In Hack, `<?hh` must always be the first 4 characters seen.

## Use XHP

If you really want to mix HTML-like elements with your Hack code, [XHP](05-xhp/01-intro.md) was made especially for that. And, it is typecheckable.
