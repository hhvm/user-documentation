``` yamlmeta
{
    "name": "isSucceeded",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/ResultOrExceptionWrapper.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\ResultOrExceptionWrapper"
}
```




Indicates whether the ` Awaitable ` associated with this wrapper exited
normally




``` Hack
public function isSucceeded(): bool;
```




If ` isSucceeded() ` returns `` true ``, ``` isFailed() ``` returns ```` false ````.




## Returns




+ ` bool ` - `` true `` if the ``` Awaitable ``` succeeded; ```` false ```` otherwise.
<!-- HHAPIDOC -->
