``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values of the current `` Pair `` up to
but not including the first value that produces ``` false ``` when passed to the
specified callback




``` Hack
public function takeWhile(
  callable $callback,
):     ImmVector<mixed>;
```




## Parameters




+ ` callable $callback ` - The callback that is used to determine the stopping
  condition.




## Returns




* ` ImmVector<mixed> ` - An `` ImmVector `` that contains the values of the current ``` Pair ``` up
  until the callback returns ```` false ````.
<!-- HHAPIDOC -->
