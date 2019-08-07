``` yamlmeta
{
    "name": "HH\\Asio\\WrappedResult",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedResult.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedResult"
}
```




Represents the result of successful ` Awaitable ` operation




## Interface Synopsis




``` Hack
namespace HH\Asio;

final class WrappedResult implements \ResultOrExceptionWrapper {...}
```




### Public Methods




+ [` ->__construct(\T $result) `](</hack/reference/class/HH.Asio.WrappedResult/__construct/>)\
  Instantiate a `` WrappedResult ``
+ [` ->getException(): \Exception `](</hack/reference/class/HH.Asio.WrappedResult/getException/>)\
  Since this is a successful result wrapper, this always returns an
  `` InvariantException `` saying that there was no exception thrown from
  the ``` Awaitable ``` operation
+ [` ->getResult(): \T `](</hack/reference/class/HH.Asio.WrappedResult/getResult/>)\
  Since this is a successful result wrapper, this always returns the actual
  result of the `` Awaitable `` operation
+ [` ->isFailed(): bool `](</hack/reference/class/HH.Asio.WrappedResult/isFailed/>)\
  Since this is a successful result wrapper, this always returns `` false ``
+ [` ->isSucceeded(): bool `](</hack/reference/class/HH.Asio.WrappedResult/isSucceeded/>)\
  Since this is a successful result wrapper, this always returns `` true ``
<!-- HHAPIDOC -->
