``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Throws an exception unless the current ` Set ` or the `` Traversable `` is
empty




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): Set<Pair<Tv, Tu>>;
```




Since ` Set `s only support integers or strings as values, we cannot have
a `` Pair `` as a ``` Set ``` value. So in order to avoid an
```` InvalidArgumentException ````, either the current ````` Set ````` or the `````` Traversable ``````
must be empty so that we actually return an empty ``````` Set ```````.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` Set ```.




## Returns




* ` Set<Pair<Tv, Tu>> ` - The `` Set `` that combines the values of the current ``` Set ``` with
  the provided ```` Traversable ````; one of these must be empty or an
  exception is thrown.




## Examples




This example shows that ` zip ` won't thrown an `` Exception `` if at least one of the current ``` Set ``` or the ```` $traversable ```` is empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/zip/001-empty-usage.php @@




This example shows that ` zip ` will throw an `` Exception `` if the result is non-empty:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/zip/002-nonempty-exception.php @@
<!-- HHAPIDOC -->
