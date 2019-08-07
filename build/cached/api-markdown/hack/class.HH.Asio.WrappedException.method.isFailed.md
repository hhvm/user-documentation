``` yamlmeta
{
    "name": "isFailed",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedException.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedException"
}
```




Since this is a failed result wrapper, this always returns ` true `




``` Hack
public function isFailed(): bool;
```




## Returns




+ ` bool ` - `` true ``.
<!-- HHAPIDOC -->
