Traits are a mechanism for code reuse that overcomes some limitations of Hack single inheritance model.

In its simplest form a trait defines properties and method declarations.  A trait cannot be instantiated with `new`, but it can be _used_ inside one or more classes, via the `use` clause.  Informally, whenever a trait is used by a class, the property and method definitions of the trait are inlined (copy/pasted) inside the class itself.  The example below shows a simple trait defining a method that returns even numbers.  The trait is used by two, unrelated, classes.

@@ using-a-trait-examples/Simple.php @@

A class can use multiple traits, and traits themselves can use one or more traits.  The example below uses three traits, to generate even numbers, to generate odd numbers given a generator of even numbers, and to test if a number is odd:

@@ using-a-trait-examples/Multiple.php @@

Traits can contain both instance and static members. If a trait defines a static property, then each class using the trait has its own instance of the static property.

A trait can access methods and properties of the class that uses it, but these dependencies must be declared using [trait requirements](trait-and-interface-requirements.md).

### Resolution of naming conflicts

A trait can insert arbitrary properties and methods inside a class, and naming conflicts may arise.  Conflict resolution rules are different according whether the conflict concern a property or a method.

If a class uses multiple traits that define the same property, say `$x`, then every trait must define the property `$x` with the same type, visibility modifier, and initialization value.  The class itself may, or not, define again the property `$x`, subject to the same conditions as above.

Beware that at runtime all the instances of the multiply defined property `$x` are _aliased_. This might be source of unexpected interference between traits implementing unrelated services: in the example below the trait `T2` breaks the invariant of trait `T1` whenever both are used by the same class.

@@ using-a-trait-examples/PropertyConflict.php @@

For methods, a rule of thumb is "traits provide a method implementation unless the class itself does not".  If the class implements a method `m`, then traits used by the class can define methods named `m` provided that their interfaces are compatible (more precisely _super types_ of the type of the method defined in the class.  At runtime methods inserted by traits are ignored, and dispatch selects the method defined in the class.

If multiple traits used by a class define the same method `m`, and a method named `m` is not defined by the class itself, then the code is rejected altogether, independently of the method interfaces.
