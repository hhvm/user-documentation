``` yamlmeta
{
    "name": "HH\\Asio\\vmk",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` after a mapping operation has been
applied to each key and value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function vmk<\Tk, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Vector<\Tr>>;
```




This function is similar to ` vm() `, but passes element keys to the callable
as well.




This function is similar to ` Vector::mapWithKey() `, but the mapping of the
keys and values is done using `` Awaitable ``s.




This function is called ` vmk ` because we are returning a `` v ``ector and doing
a ``` m ```apping operation that includes ```` k ````eys.




` $callable ` must return an `` Awaitable ``.




The values in the ` Vector ` of the returned `` Awaitable `` are not available
until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of keys and values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\Tr>> ` - An `` Awaitable `` of ``` Vector ``` after the mapping operation has been
  applied to both the keys and values in ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vmk/001-basic-usage.php @@
<!-- HHAPIDOC -->
