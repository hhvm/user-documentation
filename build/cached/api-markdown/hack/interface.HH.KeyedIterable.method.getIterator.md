``` yamlmeta
{
    "name": "getIterator",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns an iterator that points to beginning of the current
` KeyedIterable `




``` Hack
public function getIterator(): KeyedIterator<Tk, Tv>;
```




## Returns




+ ` KeyedIterator<Tk, Tv> ` - A `` KeyedIterator `` that allows you to traverse the current
  ``` KeyedIterable ```.
<!-- HHAPIDOC -->
