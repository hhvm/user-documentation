``` yamlmeta
{
    "name": "toMap",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns a ` Map ` based on the values of the current `` ImmSet ``




``` Hack
public function toMap(): Map<arraykey, Tv>;
```




Each key of the ` Map ` will be the same as its value.




## Returns




+ ` Map<arraykey, Tv> ` - a `` Map `` that that contains the values of the current ``` ImmSet ```,
  with each key of the ```` Map ```` being the same as its value.




## Examples




See [` Set::toMap `](</hack/reference/class/Set/toMap/#examples>) for usage examples.
<!-- HHAPIDOC -->
