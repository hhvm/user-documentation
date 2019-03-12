This provides some examples of how some of the HHVM configuration options can be used to affect how a program is run. This is a work in progress and more examples will be added.

## Forcing Hack Mode

Imagine you have a program like this

@@ examples-examples/force.php @@

Notice that we are putting parameter and return types in a file that starts with `<?php`.

If we run the program like this:

```
hhvm force.php
```

we would get a fatal error because we are trying to use type hints in a non-Hack code file. However, with `hhvm.force_hh`, we can override that fatal.

```
hhvm -d hhvm.force_hh=true force.php
```

and get the expected output of `5`.
