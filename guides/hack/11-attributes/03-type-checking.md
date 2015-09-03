The type checker can check user attributes by their listing in the typechecker's `.hhconfig` file

If you put the following line in your `.hhconfig` file:

```
user_attributes = UserAttr1 UserAttr2 .....
```

then the typechecker will verify any use of user attributes against this list in `.hhconfig` and error when a user attribute is not in the list. 

The primary use case for this is *misspellings*

@@ type-checking-examples/misspelling.php @@

## Special Attributes

Special attributes(04-special.md) are not typechecked in this way. This is only for custom user attributes.
