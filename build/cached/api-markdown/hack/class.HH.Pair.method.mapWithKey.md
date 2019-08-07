``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-pair.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Pair.hhi"
    ],
    "class": "HH\\Pair"
}
```




Returns an ` ImmVector ` containing the values after an operation has been
applied to each key and value in the current `` Pair ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
):     ImmVector<Tu>;
```




Every key and value in the current ` Pair ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $callback ` - The $allback containing the operation to apply to the
  current `` Pair `` keys and values.




## Returns




* ` ImmVector<Tu> ` - an `` ImmVector `` containing the values after a user-specified
  operation on the current ``` Pair ```'s keys and values is applied.
<!-- HHAPIDOC -->
