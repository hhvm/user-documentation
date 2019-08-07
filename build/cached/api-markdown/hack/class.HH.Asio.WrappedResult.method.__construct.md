``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedResult.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedResult"
}
```




Instantiate a ` WrappedResult `




``` Hack
public function __construct(
  T $result,
);
```




Normally, you will not instantiate a ` WrappedResult ` directly, but rather
have one returned back to you on a call to `` wrap() `` if the operation
succeeded.




## Parameters




+ ` T $result ` - The result of the `` Awaitable `` operation.
<!-- HHAPIDOC -->
