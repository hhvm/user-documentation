``` yamlmeta
{
    "name": "isFailed",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/ResultOrExceptionWrapper.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\ResultOrExceptionWrapper"
}
```




Indicates whether the ` Awaitable ` associated with this wrapper exited
abnormally via an exception of somoe sort




``` Hack
public function isFailed(): bool;
```




If ` isFailed() ` returns `` true ``, ``` isSucceeded() ``` returns ```` false ````.




## Returns




+ ` bool ` - `` true `` if the ``` Awaitable ``` failed; ```` false ```` otherwise.
<!-- HHAPIDOC -->
