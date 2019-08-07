``` yamlmeta
{
    "name": "HH\\Asio\\mf",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` after a filtering operation has been
applied to each value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function mf<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \Tv>>;
```




This function is similar to ` Map::filter() `, but the filtering of the
values is done using `` Awaitable ``s.




This function is called ` mf ` because we are returning a `` m ``ap, and we are
doing a ``` f ```iltering operation.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The keys and values in the ` Map ` of the returned `` Awaitable `` are not
available until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \Tv>> ` - An `` Awaitable `` of ``` Map ``` after the filtering operation has been
  applied to the values in  ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mf/001-basic-usage.php @@
<!-- HHAPIDOC -->
