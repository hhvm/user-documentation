``` yamlmeta
{
    "name": "HH\\Asio\\vw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/vectors.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Translate a ` Traversable ` of `` Awaitables `` into a single ``` Awaitable ``` of
```` Vector ```` of ````` ResultOrExceptionWrapper `````




``` Hack
namespace HH\Asio;

function vw<\Tv>(
  \  Traversable<Awaitable<\Tv>> $awaitables,
): Awaitable<Vector<\ResultOrExceptionWrapper<\Tv>>>;
```




This function is the same as ` v() `, but wraps the results into
`` ResultOrExceptionWrapper ``s.




This function takes any ` Traversable ` object of `` Awaitables `` (i.e., each
member of the ``` Traversable ``` is of type of ```` Awaitable ````, likely from a call
to a function that returned ````` Awaitable<T> `````), and transforms those
`````` Awaitables `````` into one big ``````` Awaitable ``````` ```````` Vector ```````` of ````````` ResultOrExceptionWrapper `````````.




This function is called ` vw ` because we are returning a `` v ``ector of
``` Awaitable ``` ```` w ````rapped into ````` ResultofExceptionWrapper `````s.




The ` ResultOrExceptionWrapper `s in the `` Vector `` of the returned ``` Awaitable ```
are not available until you ```` await ```` or ````` join ````` the returned `````` Awaitable ``````.




## Parameters




+ ` \ Traversable<Awaitable<\Tv>> $awaitables ` - The collection of `` Traversable `` awaitables.




## Returns




* ` Awaitable<Vector<\ResultOrExceptionWrapper<\Tv>>> ` - An `` Awaitable `` of ``` Vector ``` of ```` ResultOrExceptionWrapper ````, where
  the ````` Vector ````` was generated from each `````` Traversable `````` member in
  ``````` $awaitables ```````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.vw/001-basic-usage.php @@
<!-- HHAPIDOC -->
