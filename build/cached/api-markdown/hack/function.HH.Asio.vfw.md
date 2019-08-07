``` yamlmeta
{
    "name": "HH\\Asio\\vfw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` of ``` ResultOrExceptionWrapper ``` after a
filtering operation has been applied to each value in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function vfw<\Tk, \T>(
  \  KeyedTraversable<\Tk, \T, \mixed> $inputs,
  \callable $callable,
): Awaitable<Vector<\ResultOrExceptionWrapper<\T>>>;
```




This function is similar to ` vf() `, except the `` Vector `` in the returned
``` Awaitable ``` contains ```` ResultOrExceptionWrapper ````s instead of raw values.




This function is similar to ` Vector::filter() `, but the mapping of the values
is done using `` Awaitable ``s.




This function is called ` vfw ` because we are returning a `` v ``ector, doing a
``` f ```iltering operation and each member of the ```` Vector ```` is ````` w `````rapped by a
`````` ResultOrExceptionWrapper ``````.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The ` ResultOrExceptionWrapper `s in the `` Vector `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \T, \mixed> $inputs ` - The `` KeyedTraversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\ResultOrExceptionWrapper<\T>>> ` - An `` Awaitable `` of ``` Vector ``` of ```` ResultOrExceptionWrapper ```` after the
  filtering operation has been applied to the values in ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vfw/001-basic-usage.php @@
<!-- HHAPIDOC -->
