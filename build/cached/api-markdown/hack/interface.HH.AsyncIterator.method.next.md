``` yamlmeta
{
    "name": "next",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/AsyncIterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\AsyncIterator"
}
```




Move the async iterator to the next ` Awaitable ` position




``` Hack
public function next(): Awaitable<?tuple<mixed, Tv>>;
```




```
foreach ($async_iter await $async_iter->next() $value)
```




The above is the longhand syntax for ` await as $value `.




## Returns




+ ` Awaitable<?tuple<mixed, Tv>> ` - The next `` Awaitable `` in the iterator sequence.
<!-- HHAPIDOC -->
