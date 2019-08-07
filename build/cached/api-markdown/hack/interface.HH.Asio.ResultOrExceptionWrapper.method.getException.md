``` yamlmeta
{
    "name": "getException",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/ResultOrExceptionWrapper.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\ResultOrExceptionWrapper"
}
```




Return the underlying exception, or fail with invariant violation




``` Hack
public function getException(): Exception;
```




+ if the operation succeeded: fails with invariant violation
+ if the operation failed: returns the exception indicating failure




## Returns




* ` Exception ` - The exception that the `` Awaitable `` threw upon failure, or an
  ``` InvariantException ``` if there is no exception (i.e., because
  the ```` Awaitable ```` succeeded).
<!-- HHAPIDOC -->
