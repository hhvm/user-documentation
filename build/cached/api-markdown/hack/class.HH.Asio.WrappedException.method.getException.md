``` yamlmeta
{
    "name": "getException",
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
public function getException(): Te;
```




` getException() ` is the same as `getResult() in this case.




## Returns




+ ` Te ` - The exception thrown during the `` Awaitable `` operation.
<!-- HHAPIDOC -->
