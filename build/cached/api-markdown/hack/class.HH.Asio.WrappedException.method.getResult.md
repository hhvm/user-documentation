``` yamlmeta
{
    "name": "getResult",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedException.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedException"
}
```




Since this is a failed result wrapper, this always returns the exception
thrown during the ` Awaitable ` operation




``` Hack
public function getResult(): Tr;
```




` getResult() ` is the same as `getException() in this case.




## Returns




+ ` Tr ` - The exception thrown during the `` Awaitable `` operation.
<!-- HHAPIDOC -->
