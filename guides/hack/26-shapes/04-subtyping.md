By default, shape types must exactly match:

@@ subtyping-examples/implicit_subtype.php.type-errors @@

Shapes also support structural subtyping (also known as implicit subtypes) - that is, you can mark a shape as allowing extra fields to be defined. You can enable this behavior for a shape by adding `...` to the end of the field declaration:

@@ subtyping-examples/allow_undefined_fields.php @@

It's best to avoid this where possible - it can lead to hard to debug problems, especially when combined with optional fields:

@@ subtyping-examples/undefined_and_optional.php @@

Historical Note
===============

Prior to HHVM 3.23, all shapes allowed structural subtyping; this was changed because of the hard-to-debug issues mentioned above.
