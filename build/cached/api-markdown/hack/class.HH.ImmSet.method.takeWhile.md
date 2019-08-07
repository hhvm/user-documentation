``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` ImmSet ` containing the values of the current `` ImmSet `` up to
but not including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $callback,
): ImmSet<Tv>;
```




The returned ` ImmSet ` will always be a proper subset of the current
`` ImmSet ``.




## Parameters




+ ` callable $callback `




## Returns




* ` ImmSet<Tv> ` - An `` ImmSet `` that is a proper subset of the current ``` ImmSet ``` up
  until the callback returns ```` false ````.




## Examples




See [` Set::takeWhile `](</hack/reference/class/Set/takeWhile/#examples>) for usage examples.
<!-- HHAPIDOC -->
