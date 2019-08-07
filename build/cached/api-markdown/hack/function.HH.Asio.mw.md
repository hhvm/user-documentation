``` yamlmeta
{
    "name": "HH\\Asio\\mw",
    "sources": [
        "api-sources/hhvm/hphp/system/php/async/maps.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio_utils.hhi"
    ]
}
```




Translate a ` KeyedTraversable ` of `` Awaitables `` into a single ``` Awaitable ``` of
```` Map ```` of key/````` ResultOrExceptionWrapper ````` pairs




``` Hack
namespace HH\Asio;

function mw<\Tk as arraykey, \Tv>(
  \  KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables,
): Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tv>>>;
```




This function is the same as ` m() `, but wraps the results into
key/`` ResultOrExceptionWrapper `` pairs.




This function takes any ` KeyedTraversable ` object of `` Awaitables `` (i.e., each
member of the ``` KeyedTraversable ``` has a value of type ```` Awaitable ````, likely
from a call to a function that returned ````` Awaitable<T> `````), and transforms those
`````` Awaitables `````` into one big ``````` Awaitable ``````` ```````` Map ```````` of
key/````````` ResultOrExceptionWrapper ````````` pairs.




This function is called ` mw ` because we are returning a `` m ``ap of
``` Awaitable ``` ```` w ````rapped into ````` ResultofExceptionWrapper `````s.




The ` ResultOrExceptionWrapper ` values in the `` Map `` of the returned
``` Awaitable ``` are not available until you ```` await ```` or ````` join ````` the returned
`````` Awaitable ``````.




## Parameters




+ ` \ KeyedTraversable<\Tk, Awaitable<\Tv>> $awaitables ` - The collection of `` KeyedTraversable `` awaitables.




## Returns




* ` Awaitable<Map<\Tk, \ResultOrExceptionWrapper<\Tv>>> ` - An `` Awaitable `` of ``` Map ``` of key/```` ResultOrExceptionWrapper ```` pairs,
  where the ````` Map ````` was generated from each `````` KeyedTraversable `````` member
  in ``````` $awaitables ```````.




## Examples




@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.mw/001-basic-usage.php @@
<!-- HHAPIDOC -->
