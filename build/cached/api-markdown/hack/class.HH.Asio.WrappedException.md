``` yamlmeta
{
    "name": "HH\\Asio\\WrappedException",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/WrappedException.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\WrappedException"
}
```




Represents the result of failed ` Awaitable ` operation




## Interface Synopsis




``` Hack
namespace HH\Asio;

final class WrappedException implements \ResultOrExceptionWrapper {...}
```




### Public Methods




+ [` ->__construct(\Te $exception) `](</hack/reference/class/HH.Asio.WrappedException/__construct/>)\
  Instantiate a `` WrappedException ``
+ [` ->getException(): \Te `](</hack/reference/class/HH.Asio.WrappedException/getException/>)\
  Since this is a failed result wrapper, this always returns the exception
  thrown during the `` Awaitable `` operation
+ [` ->getResult(): \Tr `](</hack/reference/class/HH.Asio.WrappedException/getResult/>)\
  Since this is a failed result wrapper, this always returns the exception
  thrown during the `` Awaitable `` operation
+ [` ->isFailed(): bool `](</hack/reference/class/HH.Asio.WrappedException/isFailed/>)\
  Since this is a failed result wrapper, this always returns `` true ``
+ [` ->isSucceeded(): bool `](</hack/reference/class/HH.Asio.WrappedException/isSucceeded/>)\
  Since this is a failed result wrapper, this always returns `` false ``
<!-- HHAPIDOC -->
