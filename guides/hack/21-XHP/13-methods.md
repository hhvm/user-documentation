Remember, all XHP Objects derive from the [`XHPRoot`](/hack/XHP/interfaces) interface and an object that implements `XHPRoot`
has some public methods that can be called.

## XHP Object Methods

Method | Description
--------|------------
`appendChild(mixed $child): this` | Adds `$child` to the end of the XHP object's array of children. If `$child` is an array, each item in the array will be appended.
`categoryOf(string $cat): bool` | Returns whether the XHP object belongs to the category named `$cat`
`getAttribute(string $name): mixed` | Returns the value of the XHP object's attribute named `$name`. If the attribute is not set, `null` is returned, unless the attribute is required, in which case `XHPAttributeRequiredException` is thrown. If the attribute is not declared or does not exist, then `XHPAttributeNotSupportedException` is thrown. If the attribute you are reading is statically known, use `$this->:name` style syntax instead for better typechecker coverage.
`getAttributes(): Map<string, mixed>` | Returns the XHP object's array of attributes, as a cloned copy.
`getChildren(?string $selector = null): Vector<XHPChild>` | Returns the XHP object's children. If `$selector` is `null`, all children are returned. If `$selector` starts with `%`, all children belonging to the category named by `$selector` are returned. Otherwise, all children that are an instance of the class named by `$selector` are returned.
`getFirstChild(?string $selector = null):): ?XHPChild` | Returns the XHP object's first child. If `$selector` is `null`, the true first child is returned. Otherwise, the first child that matches `$selector` (or `null`) is returned.
`getLastChild(?string $selector = null):): ?XHPChild` | Returns the XHP object's last child. If `$selector` is `null`, the true last child is returned. Otherwise, the last child that matches `$selector` (or `null`) is returned.
`isAttributeSet(string $name): bool` | Returns whether the attribute with name `$name` is set.
`prependChild(mixed $child): this` | Adds $child to the beginning of the XHP object's array of children. If $child is an `array`, each item in the array will be appended.
`replaceChildren(...): this` | Replaces all the children of this XHP Object with the variable number of children passed to this method.
`setAttribute(string $name, mixed $val): this` | Sets the value of the XHP object's attribute named `$name`. The value will be checked against the attribute's type, and if they don't match, `XHPInvalidAttributeException` is thrown. If the attribute is not declared or does not exist, then `XHPAttributeNotSupportedException` is thrown.
`setAttributes(KeyedTraversable<string, mixed> $attrs): this` | Replaces the XHP object's array of attributes with `$attrs`. Same errors can apply as `setAttribute()`.

@@ methods-examples/list-builder.php @@
