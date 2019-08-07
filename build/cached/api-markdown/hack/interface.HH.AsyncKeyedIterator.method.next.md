``` yamlmeta
{
    "name": "next",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/AsyncKeyedIterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\AsyncKeyedIterator"
}
```




Move the async iterator to the next ` Awaitable ` position




``` Hack
public function next(): Awaitable<?tuple<Tk, Tv>>;
```




```
foreach ($async_iter await $async_iter->next() $key=>$value)
```




The above is the longhand syntax for ` await as $key=>$value `.




## Returns




+ ` Awaitable<?tuple<Tk, Tv>> ` - The next `` Awaitable `` in the iterator sequence.
<!-- HHAPIDOC -->
