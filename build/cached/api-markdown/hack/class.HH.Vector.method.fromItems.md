``` yamlmeta
{
    "name": "fromItems",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/collections/ext_collections-vector.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/Vector.hhi"
    ],
    "class": "HH\\Vector"
}
```




Creates a ` Vector ` from the given `` Traversable ``, or an empty ``` Vector ``` if
```` null ```` is passed




``` Hack
public static function fromItems(
  ?Traversable<Tv> $iterable,
): Vector<Tv>;
```




This is the static method version of the ` Vector::__construct() `
constructor.




## Parameters




+ ` ?Traversable<Tv> $iterable `




## Returns




* ` Vector<Tv> ` - A `` Vector `` with the values from the ``` Traversable ```; or an empty
  ```` Vector ```` if the ````` Traversable ````` is `````` null ``````.




## Examples










@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.HH.Vector/fromItems/001-basic-usage.php @@
<!-- HHAPIDOC -->
