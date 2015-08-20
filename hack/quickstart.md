Focus on:

1. Prerequisites (install HHVM and the typechecker)
2. Discuss the typechecker
 - .hhconfig in source directory
3. Simple, simple example Hack program showing types/type annotations
 - run the type checker on it; run it on HHVM
 - Emphasize that while something might not type check, it can still run on HHVM. They are, in essence, separate entities (the typechecker and HHVM). 
4. More involved example showing the key features of generics, async, collections and maybe lambdas, pointing to the documentation for each.
5. Maybe discuss how best to convert current PHP code to Hack
 - Hackificator?
 - By Hand?
 - // decl and // partial modes?

