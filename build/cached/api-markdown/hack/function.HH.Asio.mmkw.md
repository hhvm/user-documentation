``` yamlmeta
{
    "name": "HH\\Asio\\mmkw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` of ``` ResultOrExceptionWrapper ``` after a
mapping operation has been applied to each key/value pair in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function mmkw<\Tk as arraykey, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tr>>>;
```




This function is similar to ` mmk() `, except the `` Map `` in the returned
``` Awaitable ``` contains values of ```` ResultOrExceptionWrapper ```` instead of raw
values.




This function is similar to ` Map::mapWithKey() `, but the mapping of the keys
and values is done using `` Awaitable ``s.




This function is called ` mmkw ` because we are returning a `` m ``ap, doing a
``` m ```apping operation on ```` k ````eys and values, and each value member in the ````` Map `````
is `````` w ``````rapped by a ``````` ResultOrExceptionWrapper ```````.




` $callable ` must return an `` Awaitable ``.




The ` ResultOrExceptionWrapper `s in the `` Map `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of keys and values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tr>>> ` - An `` Awaitable `` of ``` Map ``` of key/```` ResultOrExceptionWrapper ```` pairs
  after the mapping operation has been applied to the keys an values
  in ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mmkw/001-basic-usage.php @@
<!-- HHAPIDOC -->
