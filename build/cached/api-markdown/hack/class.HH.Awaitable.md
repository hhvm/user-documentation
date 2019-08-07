``` yamlmeta
{
    "name": "HH\\Awaitable",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/classes.hhi"
    ],
    "class": "HH\\Awaitable"
}
```




## Interface Synopsis




``` Hack
namespace HH;

abstract class Awaitable {...}
```




### Public Methods




+ [` ::setOnIOWaitEnterCallback(?\callable $callback): \void `](</hack/reference/class/HH.Awaitable/setOnIOWaitEnterCallback/>)
+ [` ::setOnIOWaitExitCallback(?\callable $callback): \void `](</hack/reference/class/HH.Awaitable/setOnIOWaitExitCallback/>)
+ [` ::setOnJoinCallback(?\callable $callback): \void `](</hack/reference/class/HH.Awaitable/setOnJoinCallback/>)
+ [` ->getName(): string `](</hack/reference/class/HH.Awaitable/getName/>)
+ [` ->isFailed(): bool `](</hack/reference/class/HH.Awaitable/isFailed/>)
+ [` ->isFinished(): bool `](</hack/reference/class/HH.Awaitable/isFinished/>)
+ [` ->isSucceeded(): bool `](</hack/reference/class/HH.Awaitable/isSucceeded/>)







### Private Methods




* [` ->__construct() `](</hack/reference/class/HH.Awaitable/__construct/>)
<!-- HHAPIDOC -->
