``` yamlmeta
{
    "name": "HH\\Asio\\mfkw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Map `` of ``` ResultOrExceptionWrapper ``` after a
filtering operation has been applied to each key/value pair in the provided
```` KeyedTraversable ````




``` Hack
namespace HH\Asio;

function mfkw<\Tk as arraykey, \T>(
  \  KeyedTraversable<\Tk, \T> $inputs,
  \callable $callable,
): Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\T>>>;
```




This function is similar to ` mfk() `, except the `` Map `` in the returned
``` Awaitable ``` contains values of ```` ResultOrExceptionWrapper ```` instead of raw
values.




This function is similar to ` Map::filterWithKey() `, but the filtering of the
keys and values is done using `` Awaitable ``s.




This function is called ` mfkw ` because we are returning a `` m ``ap, doing a
``` f ```iltering operation on ```` k ````eys and values, and each value member in the
````` Map ````` is `````` w ``````rapped by a ``````` ResultOrExceptionWrapper ```````.




` $callable ` must return an `` Awaitable `` of ``` bool ```.




The ` ResultOrExceptionWrapper `s in the `` Map `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, \T> $inputs ` - The `` KeyedTraversable `` of keys and values to filter.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\T>>> ` - An `` Awaitable `` of ``` Map ``` of key/```` ResultOrExceptionWrapper ```` pairs
  after the filtering operation has been applied to the keys an
  values in ````` $inputs `````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mfkw/001-basic-usage.php @@
<!-- HHAPIDOC -->
