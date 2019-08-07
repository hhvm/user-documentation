``` yamlmeta
{
    "name": "HH\\Asio\\v",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vm.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Translate a ` Traversable ` of `` Awaitables `` into a single ``` Awaitable ``` of
```` Vector ````




``` Hack
namespace HH\Asio;

function v<\Tv>(
  \  Traversable<Awaitable<\Tv>> $awaitables,
): Awaitable<Vector<\Tv>>;
```




This function takes any ` Traversable ` object of `` Awaitables `` (i.e., each
member of the ``` Traversable ``` is of type of ```` Awaitable ````, likely from a call
to a function that returned ````` Awaitable<T> `````), and transforms those
`````` Awaitables `````` into one big ``````` Awaitable ``````` ```````` Vector ````````.




This function is called ` v ` we are returning a `` v ``ector of ``` Awaitable ```.




Only When you ` await ` or `` join `` the resulting ``` Awaitable ```, will all of the
values in the ```` Vector ```` within the returned ````` Awaitable ````` be available.




## Parameters




+ ` \ Traversable<Awaitable<\Tv>> $awaitables ` - The collection of `` Traversable `` awaitables.




## Returns




* ` Awaitable<Vector<\Tv>> ` - An `` Awaitable `` of ``` Vector ```, where the ```` Vector ```` was generated from
  each ````` Traversable ````` member in `````` $awaitables ``````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.v/001-basic-usage.php @@
<!-- HHAPIDOC -->
