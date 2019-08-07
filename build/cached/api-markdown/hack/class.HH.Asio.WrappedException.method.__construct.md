``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedException.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedException"
}
```




Instantiate a ` WrappedException `




``` Hack
public function __construct(
  Te $exception,
);
```




Normally, you will not instantiate a ` WrappedException ` directly, but
rather have one returned back to you on a call to `` wrap() `` if the
operation failed.




## Parameters




+ ` Te $exception `
<!-- HHAPIDOC -->
