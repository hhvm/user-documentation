``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-set.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Set.hhi"
    ],
    "class": "HH\\Set"
}
```




Creates a ` Set ` from the given `` Traversable ``, or an empty ``` Set ``` if ```` null ````
is passed




``` Hack
public function __construct(
  ?Traversable<Tv> $iterable = NULL,
): void;
```




## Parameters




+ ` ?Traversable<Tv> $iterable = NULL `




## Returns




* ` void `




## Examples




This example shows how to create a ` Set ` from various `` Traversable ``s. Notice that duplicate values in the input ``` Traversable ```s only appear once in the output ```` Set ````.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/__construct/001-basic-usage.php @@




This example shows how passing ` null ` to the constructor creates an empty `` Set ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/__construct/002-null-empty.php @@
<!-- HHAPIDOC -->
