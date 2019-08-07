``` yamlmeta
{
    "name": "HH\\Asio\\mmw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` of ``` ResultOrExceptionWrapper ``` after a
mapping operation has been applied to each value in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function mmw<\Tk as arraykey, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tr>>>;
```




This function is similar to ` mm() `, except the `` Map `` in the returned
``` Awaitable ``` contains values of ```` ResultOrExceptionWrapper ```` instead of raw
values.




This function is similar to ` Map::map() `, but the mapping of the values
is done using `` Awaitable ``s.




This function is called ` mmw ` because we are returning a `` m ``ap, doing a
``` m ```apping operation and each value member in the ```` Map ```` is ````` w `````rapped by a
`````` ResultOrExceptionWrapper ``````.




` $callable ` must return an `` Awaitable ``.




The ` ResultOrExceptionWrapper `s in the `` Map `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tr>>> ` - An `` Awaitable `` of ``` Map ``` of key/```` ResultOrExceptionWrapper ```` pairs
  after the mapping operation has been applied to the values in
  ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mmw/001-basic-usage.php @@
<!-- HHAPIDOC -->
