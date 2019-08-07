``` yamlmeta
{
    "name": "HH\\Asio\\m",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vm.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Translate a ` KeyedTraversable ` of `` Awaitables `` into a single ``` Awaitable of ```Map`




``` Hack
namespace HH\Asio;

function m<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables,
): Awaitable<Map<\Tk, \Tv>>;
```




This function takes any ` KeyedTraversable ` object of `` Awaitables `` (i.e.,
each member of the ``` KeyedTraversable ``` has a value of type of ```` Awaitable ````,
likely from a call to a function that returned ````` Awaitable<T> `````), and
transforms those `````` Awaitables `````` into one big ``````` Awaitable ``````` ```````` Map ````````.




This function is called ` m ` because we are returning a `` m ``ap of ``` Awaitable ```.




Only When you ` await ` or `` join `` the resulting ``` Awaitable ```, will all of the
key/values in the ```` Map ```` within the returned ````` Awaitable ````` be available.




## Parameters




+ ` \ KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables ` - The collection of `` KeyedTraversable `` awaitables.




## Returns




* ` Awaitable<Map<\Tk, \Tv>> ` - An `` Awaitable `` of ``` Map ```, where the ```` Map ```` was generated from
  each ````` KeyedTraversable ````` member in `````` $awaitables ``````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.m/001-basic-usage.php @@
<!-- HHAPIDOC -->
