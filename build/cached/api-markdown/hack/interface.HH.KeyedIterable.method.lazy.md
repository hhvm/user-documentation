``` yamlmeta
{
    "name": "lazy",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a lazy, access elements only when needed view of the current
` KeyedIterable `




``` Hack
public function lazy(): KeyedIterable<Tk, Tv>;
```




Normally, memory is allocated for all of the elements of the
` KeyedIterable `. With a lazy view, memory is allocated for an element only
when needed or used in a calculation like in `` map() `` or ``` filter() ```.




## Returns




+ ` KeyedIterable<Tk, Tv> ` - a `` KeyedIterable `` representing the lazy view into the current
  ``` KeyedIterable ```.
<!-- HHAPIDOC -->
