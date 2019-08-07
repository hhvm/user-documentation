``` yamlmeta
{
    "name": "HH\\Asio\\mfk",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` after a filtering operation has been
applied to each key and value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function mfk<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \Tv>>;
```




This function is similar to ` mf() `, but passes element keys to the callable
as well.




This function is similar to ` Map::filterWithKey() `, but the filtering of the
keys and values is done using `` Awaitable ``s.




This function is called ` mfk ` because we are returning a `` m ``ap, doing a
a ``` f ```iltering operation that includes ```` k ````eys.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The keys and values in the ` Map ` of the returned `` Awaitable `` are not
available until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of keys and values to filter.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \Tv>> ` - An `` Awaitable `` of ``` Map ``` after the filtering operation has been
  applied to both the keys and values in ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mfk/001-basic-usage.php @@
<!-- HHAPIDOC -->
