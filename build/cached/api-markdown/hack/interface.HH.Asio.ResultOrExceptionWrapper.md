``` yamlmeta
{
    "name": "HH\\Asio\\ResultOrExceptionWrapper",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/ResultOrExceptionWrapper.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ],
    "class": "HH\\Asio\\ResultOrExceptionWrapper"
}
```




Represents a result of operation that either has a successful result of an
` Awaitable ` or the exception object if that `` Awaitable `` failed




This is an interface. You get generally ` ResultOrExceptionWrapper ` by calling
`` wrap() ``, passing in the ``` Awaitable ```, and a ```` WrappedResult ```` or
````` WrappedException ````` is returned.




## Interface Synopsis




``` Hack
namespace HH\Asio;

interface ResultOrExceptionWrapper {...}
```




### Public Methods




+ [` ->getException(): \Exception `](</hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/getException/>)\
  Return the underlying exception, or fail with invariant violation
+ [` ->getResult(): \T `](</hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/getResult/>)\
  Return the result of the operation, or throw underlying exception
+ [` ->isFailed(): bool `](</hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/isFailed/>)\
  Indicates whether the `` Awaitable `` associated with this wrapper exited
  abnormally via an exception of somoe sort
+ [` ->isSucceeded(): bool `](</hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/isSucceeded/>)\
  Indicates whether the `` Awaitable `` associated with this wrapper exited
  normally
<!-- HHAPIDOC -->
