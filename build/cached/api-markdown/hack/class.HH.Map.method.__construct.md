``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-map.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Map.hhi"
    ],
    "class": "HH\\Map"
}
```




Creates a ` Map ` from the given `` KeyedTraversable ``, or an empty ``` Map ``` if
```` null ```` is passed




``` Hack
public function __construct(
  ?KeyedTraversable<Tk, Tv> $iterable = NULL,
): void;
```




## Parameters




+ ` ?KeyedTraversable<Tk, Tv> $iterable = NULL `




## Returns




* ` void `




## Examples




This example shows how to create a ` Map ` from various `` KeyedTraversable ``s:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/__construct/001-basic-usage.php @@




This example shows how passing ` null ` to the constructor creates an empty `` Map ``:







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Map/__construct/002-null-empty.php @@
<!-- HHAPIDOC -->
