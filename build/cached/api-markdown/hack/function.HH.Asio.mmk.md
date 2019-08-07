``` yamlmeta
{
    "name": "HH\\Asio\\mmk",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` after a mapping operation has been
applied to each key and value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function mmk<\Tk as arraykey, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \Tr>>;
```




This function is similar to ` mm() `, but passes element keys to the callable
as well.




This function is similar to ` Map::mapWithKey() `, but the mapping of the keys
and values is done using `` Awaitable ``s.




This function is called ` mmk ` because we are returning a `` m ``ap and doing a
a ``` m ```apping operation that includes ```` k ````eys.




` $callable ` must return an `` Awaitable ``.




The keys and values in the ` Map ` of the returned `` Awaitable `` are not
available until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of keys and values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \Tr>> ` - An `` Awaitable `` of ``` Map ``` after the mapping operation has been
  applied to both the keys and values in ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mmk/001-basic-usage.php @@
<!-- HHAPIDOC -->
