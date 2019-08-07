``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns an immutable map (` ImmMap `) based on the values of the current
`` ImmSet ``




``` Hack
public function toImmMap(): ImmMap<arraykey, Tv>;
```




Each key of the ` Map ` will be the same as its value.




## Returns




+ ` ImmMap<arraykey, Tv> ` - an `` ImmMap `` that that contains the values of the current
  ``` ImmSet ```, with each key of the ```` ImmMap ```` being the same as its
  value.




## Examples




See [` Set::toImmMap `](</hack/reference/class/Set/toImmMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
