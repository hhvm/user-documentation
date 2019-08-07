``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/IteratorAggregate.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterable"
}
```




Returns a lazy, access elements only when needed view of the current
` Iterable `




``` Hack
public function lazy(): Iterable<Tv>;
```




Normally, memory is allocated for all of the elements of the ` Iterable `.
With a lazy view, memory is allocated for an element only when needed or
used in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` Iterable<Tv> ` - an `` Iterable `` representing the lazy view into the current
  ``` Iterable ```.
<!-- HHAPIDOC -->
