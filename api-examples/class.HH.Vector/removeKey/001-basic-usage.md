Since `Vector::removeKey()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$v` itself, you can chain a bunch of `removeKey()` calls together.
