``` yamlmeta
{
    "name": "getResult",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/ResultOrExceptionWrapper.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\ResultOrExceptionWrapper"
}
```




Return the result of the operation, or throw underlying exception




``` Hack
public function getResult(): T;
```




+ if the operation succeeded: return its result
+ if the operation failed: throw the exception incating failure




## Returns




* ` T ` - the result of the `` Awaitable `` operation upon success or the
  exception that was thrown upon failed.
<!-- HHAPIDOC -->
