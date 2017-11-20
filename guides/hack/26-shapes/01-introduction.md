A *shape* consists of a group of zero or more data *field*s taken together as a whole; it is an array whose keys are tracked by the Hack typechecker. 

For example:

```
<?hh
shape('x' => int, 'y' => int)
```

The definition of a shape contains an ordered set of fields each of which has a name and a type. In the above case, the shape consists of two `int` fields, with the names `'x'` and `'y'`, respectively.

@@ introduction-examples/intro.php @@

Although we can use a shape type directly, oftentimes it is convenient to create an alias, such as the name `Point` above, and use that instead.

## Accessing Fields

A field in a shape is accessed using its name as the key in a subscript-expression that operates on a shape of the corresponding shape type. For example:

The name of a field can be written in one of two possible forms:

  * A single-quoted string (as shown in the example above)
  * A class constant of type `string` or `int` 

Note that an integer literal **cannot** be used directly as a field name.

The names of all fields in a given shape definition must be distinct and have the same form.

### Optional Fields

All fields are required, unless explicitly marked as optional. <strong>Since HHVM 3.23, nullable fields are no longer considered optional</strong>.

Fields are marked optional by preceding the field name with a `?` token:

@@ introduction-examples/optional.php @@

Nullable fields are not optional - using them interchangeably will cause typechecker errors:

@@ introduction-examples/nullable_is_not_optional.php.type-errors @@

## Class Constants

Class constants can be used in shapes. 

@@ introduction-examples/class-constants.php @@

In the case of the integer class constants in our example above, by arbitrary choice, the x-coordinate is stored in the element with key 10, while the y-coordinate is stored in the element with key 23.

## Shapes Without Type Aliases

A shape does not have to have a type alias associated with it. Here is an example of just using the literal shape syntax in all places.

@@ introduction-examples/no-alias.php @@

## Caveats

Shapes are arrays; i.e., a call to `is_array()` will return `true`. However there are some things you can do with arrays that you cannot do with shapes.

* You cannot read or write with unknown keys. e.g., `$shape[$var]` is invalid. The key must be a string literal or class constant.
* You cannot use the array append `[]` operator on a shape.
* You cannot `foreach` on shape since it doesn't implement `Traversable` or `Container`.  
