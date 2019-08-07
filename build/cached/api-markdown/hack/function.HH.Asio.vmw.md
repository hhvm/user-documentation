``` yamlmeta
{
    "name": "HH\\Asio\\vmw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` of ``` ResultOrExceptionWrapper ``` after a
mapping operation has been applied to each value in the provided
```` Traversable ````




``` Hack
namespace HH\Asio;

function vmw<\Tv, \Tr>(
  \  Traversable<\Tv> $inputs,
  \callable $callable,
): Awaitable<Vector<\ResultOrExceptionWrapper<\Tr>>>;
```




This function is similar to ` vm() `, except the `` Vector `` in the returned
``` Awaitable ``` contains ```` ResultOrExceptionWrapper ````s instead of raw values.




This function is similar to ` Vector::map() `, but the mapping of the values
is done using `` Awaitable ``s.




This function is called ` vmw ` because we are returning a `` v ``ector, doing a
``` m ```apping operation and each member of the ```` Vector ```` is ````` w `````rapped by a
`````` ResultOrExceptionWrapper ``````.




` $callable ` must return an `` Awaitable ``.




The ` ResultOrExceptionWrapper `s in the `` Vector `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ Traversable<\Tv> $inputs ` - The `` Traversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\ResultOrExceptionWrapper<\Tr>>> ` - An `` Awaitable `` of ``` Vector ``` of ```` ResultOrExceptionWrapper ```` after the
  mapping operation has been applied to the values in ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vmw/001-basic-usage.php @@
<!-- HHAPIDOC -->
