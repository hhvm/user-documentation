``` yamlmeta
{
    "name": "toImmVector",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Returns an immutable vector (` ImmVector `) with the values of the current
`` Set ``




``` Hack
public function toImmVector(): ImmVector<Tv>;
```




## Returns




+ ` ImmVector<Tv> ` - an `` ImmVector `` (integer-indexed) with the values of the current
  ``` Set ```.




## Examples




This example shows that ` toImmVector ` returns an `` ImmVector `` containing the ``` Set ```'s values. Mutating the original ```` Set ```` doesn't affect the ````` ImmVector `````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/toImmVector/001-basic-usage.php @@
<!-- HHAPIDOC -->
