``` yamlmeta
{
    "name": "HH\\Asio\\mm",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` containing after a mapping operation has
been applied to each value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function mm<\Tk as arraykey, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \Tr>>;
```




This function is similar to ` Map::map() `, but the mapping of the values
is done using `` Awaitable ``s.




This function is called ` mm ` because we are returning a `` m ``ap, and doing a
``` m ```apping operation.




` $callable ` must return an `` Awaitable ``.




The keys and values in the ` Map ` of the returned `` Awaitable `` are not
available until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \Tr>> ` - An `` Awaitable `` of ``` Map ``` after the mapping operation has been
  applied to the values in  ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mm/001-basic-usage.php @@
<!-- HHAPIDOC -->
