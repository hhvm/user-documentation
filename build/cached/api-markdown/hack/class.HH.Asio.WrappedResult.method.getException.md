``` yamlmeta
{
    "name": "getException",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedResult.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedResult"
}
```




Since this is a successful result wrapper, this always returns an
` InvariantException ` saying that there was no exception thrown from
the `` Awaitable `` operation




``` Hack
public function getException(): Exception;
```




## Returns




+ ` Exception ` - An `` InvariantException ``.
<!-- HHAPIDOC -->
