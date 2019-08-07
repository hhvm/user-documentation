``` yamlmeta
{
    "name": "fromItems",
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
public static function fromItems(
  ?Traversable<Tv> $iterable,
): Set<Tv>;
```




This is the static method version of the ` Set::__construct() ` constructor.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` Set<Tv> ` - A `` Set `` with the values from the ``` Traversable ```; or an empty ```` Set ````
  if the ````` Traversable ````` is `````` null ``````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Set/fromItems/001-basic-usage.php @@
<!-- HHAPIDOC -->
