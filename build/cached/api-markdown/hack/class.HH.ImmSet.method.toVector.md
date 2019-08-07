``` yamlmeta
{
    "name": "toVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/ImmSet.hhi"
    ],
    "class": "HH\\ImmSet"
}
```




Returns a ` Vector ` of the current `` ImmSet `` values




``` Hack
public function toVector(): Vector<Tv>;
```




## Returns




+ ` Vector<Tv> ` - a `` Vector `` (integer-indexed) that contains the values of the
  current ``` ImmSet ```.




## Examples




See [` Set::toVector `](</hack/reference/class/Set/toVector/#examples>) for usage examples.
<!-- HHAPIDOC -->
