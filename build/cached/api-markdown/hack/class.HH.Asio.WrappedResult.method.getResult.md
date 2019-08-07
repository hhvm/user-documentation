``` yamlmeta
{
    "name": "getResult",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedResult.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedResult"
}
```




Since this is a successful result wrapper, this always returns the actual
result of the ` Awaitable ` operation




``` Hack
public function getResult(): T;
```




## Returns




+ ` T ` - The result of the `` Awaitable `` operation.
<!-- HHAPIDOC -->
