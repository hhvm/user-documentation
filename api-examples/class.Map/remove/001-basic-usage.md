Since `Map::remove()` returns a [shallow copy](https://en.wikipedia.org/wiki/Object_copying#Shallow_copy) of `$m` itself, you can chain a bunch of `remove()` calls together.
