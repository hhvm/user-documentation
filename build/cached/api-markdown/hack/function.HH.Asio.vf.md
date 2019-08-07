``` yamlmeta
{
    "name": "HH\\Asio\\vf",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` after a filtering operation has been
applied to each value in the provided ``` KeyedTraversable ```




``` Hack
namespace HH\Asio;

function vf<\Tk, \T>(
  \  KeyedTraversable<\Tk, \T, \mixed> $inputs,
  \callable $callable,
): Awaitable<Vector<\T>>;
```




This function is similar to ` Vector::filter() `, but the filtering of the
values is done using `` Awaitable ``s.




This function is called ` vf ` because we are returning a `` v ``ector, and
we are doing a ``` f ```iltering operation.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The values in the ` Vector ` of the returned `` Awaitable `` are not available
until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \T, \mixed> $inputs ` - The `` KeyedTraversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\T>> ` - An `` Awaitable `` of ``` Vector ``` after the filtering operation has been
  applied to the values in  ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vf/001-basic-usage.php @@
<!-- HHAPIDOC -->
