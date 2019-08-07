``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Creates a ` Vector ` from the given `` Traversable ``, or an empty ``` Vector ```
if ```` null ```` is passed




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




This example shows how to create a ` Vector ` from various `` Traversable ``s:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/__construct/001-basic-usage.php @@




This example shows how passing ` null ` to the constructor creates an empty `` Vector ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/__construct/002-null-empty.php @@
<!-- HHAPIDOC -->
