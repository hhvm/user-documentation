``` yamlmeta
{
    "name": "toArray",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an ` array ` containing the values from the current `` ImmSet ``




``` Hack
public function toArray(): HH\array<Tv, Tv>;
```




For the returned ` array `, each key is the same as its associated value.




## Returns




+ ` HH\array<Tv, Tv> ` - an `` array `` containing the values from the current ``` ImmSet ```,
  where each key of the ```` array ```` are the same as each value.




## Examples




See [` Set::toArray `](</hack/reference/class/Set/toArray/#examples>) for usage examples.
<!-- HHAPIDOC -->
