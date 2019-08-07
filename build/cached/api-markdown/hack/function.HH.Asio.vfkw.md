``` yamlmeta
{
    "name": "HH\\Asio\\vfkw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` of ``` ResultOrExceptionWrapper ``` after a
filtering operation has been applied to each key/value pair in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function vfkw<\Tk, \T>(
  \  KeyedTraversable<\Tk, \T> $inputs,
  \callable $callable,
): Awaitable<Vector<\ResultOrExceptionWrapper<\T>>>;
```




This function is similar to ` vfk() `, except the `` Vector `` in the returned
``` Awaitable ``` contains ```` ResultOrExceptionWrapper ````s instead of raw values.




This function is similar to ` Vector::filterWithKey() `, but the mapping of the
key/value pairs are done using `` Awaitable ``s.




This function is called ` vfkw ` because we are returning a `` v ``ector, doing a
``` f ```iltering operation that includes both ```` k ````eys and values, and each member
of the ````` Vector ````` is `````` w ``````rapped by a ``````` ResultOrExceptionWrapper ```````.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The ` ResultOrExceptionWrapper `s in the `` Vector `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \T> $inputs ` - The `` KeyedTraversable `` of keys and values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\ResultOrExceptionWrapper<\T>>> ` - An `` Awaitable `` of ``` Vector ``` of ```` ResultOrExceptionWrapper ```` after the
  filtering operation has been applied to the keys and values in
  ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vfkw/001-basic-usage.php @@
<!-- HHAPIDOC -->
