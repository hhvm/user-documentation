``` yamlmeta
{
    "name": "zip",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Throws an exception unless the current ` ImmSet ` or the `` Traversable `` is
empty




``` Hack
public function zip<Tu>(
  Traversable<Tu> $traversable,
): ImmSet<Pair<Tv, Tu>>;
```




Since ` ImmSet `s only support integers or strings as values, we cannot
have a `` Pair `` as an ``` ImmSet ``` value. So in order to avoid an
```` InvalidArgumentException ````, either the current ````` ImmSet ````` or the
`````` Traversable `````` must be empty so that we actually return an empty ``````` ImmSet ```````.




## Parameters




+ ` Traversable<Tu> $traversable ` - The `` Traversable `` to use to combine with the
  elements of the current ``` ImmSet ```.




## Returns




* ` ImmSet<Pair<Tv, Tu>> ` - The `` ImmSet `` that combines the values of the current ``` ImmSet ```
  with the provided ```` Traversable ````; one of these must be empty or
  an exception is thrown.




## Examples




See [` Set::zip `](</hack/reference/class/Set/zip/#examples>) for usage examples.
<!-- HHAPIDOC -->
