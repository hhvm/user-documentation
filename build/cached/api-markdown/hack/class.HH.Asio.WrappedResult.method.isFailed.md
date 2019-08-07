``` yamlmeta
{
    "name": "isFailed",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedResult.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedResult"
}
```




Since this is a successful result wrapper, this always returns ` false `




``` Hack
public function isFailed(): bool;
```




## Returns




+ ` bool ` - `` false ``.
<!-- HHAPIDOC -->
