# Type Annotations and Interfaces

Like other [types](../types/introduction.md) in Hack, you can annotate functions and properties with XHP as well.

There is also a list of methods available to XHP objects that you can call to help inspect the object itself, as well as modify its attributes and/or children.

## Type Annotations

Adding type annotations to XHP is fairly straightforward since there are really only two interfaces you will use:

Interface | Description
----------|------------
`XHPRoot` | Any object that is an instance of an XHP class.
`XHPChild` | The set of items that are valid values for the following `<div>{$xhpchild}</div>`. This includes XHP Objects, strings, integers, floats, and arrays of the aforementioned. `XHPChild` is an instance of `XHPRoot`, but the other primitive types mentioned here are not.

@@ typing-examples/annotate.php @@

If you might return a normal Hack type like a `string` or an XHP Object, returning `XHPChild` is a good annotation.

## XHP Object Interface

Remember, all XHP objects derive from `XHPRoot`, and `XHPRoot` has some public methods on it that any XHP object can call.

Method | Description
-------|------------
`appendChild(mixed $child): this` | Adds $child to the end of the XHP object's array of children. If $child is an `array`, each item in the array will be appended.
`categoryOf(string $cat): bool` | Returns whether the XHP object belongs to the category named `$cat`
`getAttribute(string $name): mixed` | Returns the value of the XHP object's attribute named `$name`. If the attribute is not set, `null` is returned, unless the attribute is required, in which case `XHPAttributeRequiredException` is thrown. If the attribute is not declared or does not exist, then `XHPAttributeNotSupportedException` is thrown. If the attribute you are reading is statically known, use `$this->:name` style syntax instead for better typechecker coverage.
`getAttributes(): Map<string, mixed>` | Returns the XHP object's array of attributes, as a cloned copy.
`getChildren(?string $selector = null): Vector<XHPChild>` | Returns the XHP object's children. If `$selector` is `null`, all children are returned. If `$selector` starts with `%`, all children belonging to the category named by `$selector` are returned. Otherwise, all children that are `instanceof` the class named by `$selector` are returned. 
`getFirstChild(?string $selector = null):): ?XHPChild` | Returns the XHP object's first child. If `$selector` is `null`, the true first child is returned. Otherwise, the first child that matches `$selector` (or `null`) is returned.
`getLastChild(?string $selector = null):): ?XHPChild` | Returns the XHP object's last child. If `$selector` is `null`, the true last child is returned. Otherwise, the last child that matches `$selector` (or `null`) is returned.
`isAttributeSet(string $name): bool` | Returns whether the attribute with name `$name` is set.
`prependChild(mixed $child): this` | Adds $child to the beginning of the XHP object's array of children. If $child is an `array`, each item in the array will be appended.
`replaceChildren(...): this` | Replaces all the children of this XHP Object with the variable number of children passed to this method.
`setAttribute(string $name, mixed $val): this` | Sets the value of the XHP object's attribute named `$name`. The value will be checked against the attribute's type, and if they don't match, `XHPInvalidAttributeException` is thrown. If the attribute is not declared or does not exist, then `XHPAttributeNotSupportedException` is thrown. If the attribute you are reading is statically known, use `$this->:name = $value` style syntax instead for better typechecker coverage.
`setAttributes(KeyedTraversable<string, mixed> $attrs): this` | Replaces the XHP object's array of attributes with `$attrs`. Same errors can apply as `setAttribute()`.

@@ typing-examples/use-object-methods.php @@
