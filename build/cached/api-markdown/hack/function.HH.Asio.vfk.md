``` yamlmeta
{
    "name": "HH\\Asio\\vfk",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` after a filtering operation has been
applied to each key and value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function vfk<\Tk, \T>(
  \  KeyedTraversable<\Tk, \T> $inputs,
  \callable $callable,
): Awaitable<Vector<\T>>;
```




This function is similar to ` vf() `, but passes element keys to the callable
as well.




This function is similar to ` Vector::filterWithKey() `, but the filtering of
the keys and values is done using `` Awaitable ``s.




This function is called ` vfk ` because we are returning a `` v ``ector, doing a
a ``` f ```iltering operation that includes ```` k ````eys.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The values in the ` Vector ` of the returned `` Awaitable `` are not available
until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \T> $inputs ` - The `` KeyedTraversable `` of keys and values to filter.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\T>> ` - An `` Awaitable `` of ``` Vector ``` after the filtering operation has been
  applied to both the keys and values in ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vfk/001-basic-usage.php @@
<!-- HHAPIDOC -->
