You may have noticed that not everything is [annotated](annotations.md) (e.g., local variables). However, the typechecker is still able to make rational assertions on type mismatches. It fills in the annotation gaps through *type inference*. 

Basically type inference is a deduction of what the type of a variable should be based upon the knowns that are given to it. And the typechecker can do inference based on the knowns of the annotations it does see as well as the current flow of the program.

## Local Variables

Local variables are not type annotated. Their types are inferred based on the flow of the program. In fact, you can assign different values of different types to local variables. When a local variable is returned from the function or method, or when it is compared or somehow otherwise used against a variable of a known type, is the only point at which it matters what the type of a local variable is.

@@ inference-examples/local-variables.php @@

### Unresolved Types

The above example showed a case where a variable was assigned to an `int ` in both branches of the `if/else`. This makes it easy for the typechecker to determine that a variable can and only will be an `int` when it encounters the `return`.

However what happens if instead of assigning a variable to the same type in both branches of a conditional, you decide to assign it to a different type in each branch?

@@ inference-examples/unresolved.php.type-errors @@

In the conditional branch, we are assigning the same local variable to one of two types. This makes the local variable *unresolved*, meaning that the typechecker knows that the variable can be one of the two types, but doesn't know which. So at this point, only operations that can be performed on **both** types will be permitted.

## Class Properties

Normally class properties are annotated, so the typechecker initially knows their expected type. But sometimes the typechecker has to make some assumptions that makes inferring further use of a property a bit more complicated than it is for local variables.

@@ inference-examples/props.php.type-errors @@

The typechecker only infers local to a function. It makes no assumptions about what might happen outside the function, say, for example, if a function calls another function. That's why the typechecker will throw an error even though we know by the eye test that there is not a `null` problem.

This issue is solved by using local variables set to the property value or by using `invariant()`.
