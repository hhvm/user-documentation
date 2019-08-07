``` yamlmeta
{
    "name": "HH\\Asio\\vm",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Returns an ` Awaitable ` of `` Vector `` containing after a mapping operation has
been applied to each value in the provided ``` Traversable ```




``` Hack
namespace HH\Asio;

function vm<\Tv, \Tr>(
  \  Traversable<\Tv> $inputs,
  \callable $callable,
): Awaitable<Vector<\Tr>>;
```




This function is similar to ` Vector::map() `, but the mapping of the values
is done using `` Awaitable ``s.




This function is called ` vm ` because we are returning a `` v ``ector, and
we are doing a ``` m ```apping operation.




` $callable ` must return an `` Awaitable ``.




The values in the ` Vector ` of the returned `` Awaitable `` are not available
until you ``` await ``` or ```` join ```` the returned ````` Awaitable `````.




## Parameters




+ ` \ Traversable<\Tv> $inputs ` - The `` Traversable `` of values to map.
+ ` \callable $callable ` - The callable containing the `` Awaitable `` operation to
  apply to ``` $inputs ```.




## Returns




* ` Awaitable<Vector<\Tr>> ` - An `` Awaitable `` of ``` Vector ``` after the mapping operation has been
  applied to the values in  ```` $inputs ````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vm/001-basic-usage.php @@
<!-- HHAPIDOC -->
