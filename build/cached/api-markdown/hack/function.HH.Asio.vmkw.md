``` yamlmeta
{
    "name": "HH\\Asio\\vmkw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` of ``` ResultOrExceptionWrapper ``` after a
mapping operation has been applied to each key/value pair in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function vmkw<\Tk, \Tv, \Tr>(
  \  KeyedTraversable<\Tk, \Tv> $inputs,
  \callable $callable,
): Awaitable<Vector<\ResultOrExceptionWrapper<\Tr>>>;
```




This function is similar to ` vmk() `, except the `` Vector `` in the returned
``` Awaitable ``` contains ```` ResultOrExceptionWrapper ````s instead of raw values.




This function is similar to ` Vector::mapWithKey() `, but the mapping of the
key/value pairs are done using `` Awaitable ``s.




This function is called ` vmkw ` because we are returning a `` v ``ector, doing a
``` m ```apping operation that includes both ```` k ````eys and values, and each member
of the ````` Vector ````` is `````` w ``````rapped by a ``````` ResultOrExceptionWrapper ```````.




` $callable ` must return an `` Awaitable ``.




The ` ResultOrExceptionWrapper `s in the `` Vector `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \Tv> $inputs ` - The `` KeyedTraversable `` of keys and values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\ResultOrExceptionWrapper<\Tr>>> ` - An `` Awaitable `` of ``` Vector ``` of ```` ResultOrExceptionWrapper ```` after the
  mapping operation has been applied to the keys and values in
  ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vmkw/001-basic-usage.php @@
<!-- HHAPIDOC -->
