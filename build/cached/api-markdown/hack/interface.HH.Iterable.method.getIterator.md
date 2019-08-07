``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns an iterator that points to beginning of the current ` Iterable `




``` Hack
public function getIterator(): Iterator<Tv>;
```




## Returns




+ ` Iterator<Tv> ` - An `` Iterator `` that allows you to traverse the current ``` Iterable ```.
<!-- HHAPIDOC -->
