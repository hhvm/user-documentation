``` yamlmeta
{
    "name": "HH\\Client\\typecheck",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh_client/ext_hh_client.php"
    ]
}
```




Typecheck the currently running endpoint with a given ` hh_client `




``` Hack
namespace HH\Client;

function typecheck(
  string $client_name = 'hh_client',
): TypecheckResult;
```




Does some
caching to hopefully be pretty cheap to call, especially when there are no
errors and the code isn't changing. Relies on ` hh_server ` to poke a stamp
file to say "something has changed" to invalidate our cache.




TODO Areas for future improvement:

+ Key the cache by endpoint/hhconfig location, so that we correctly support
  more than one project per HHVM instance.
+ Populate the cache separately from this function, so that
  typecheck_and_error can have a hot path that just checks "is the world
  clean" without paying the apc_fetch deserialization cost (which is most
  of the cost of this function, if I'm benchmarking correctly).
+ Storing an array (instead of an object) in APC might be faster, due to the
  way I think HHVM can optimize COW arrays.




## Parameters




* ` string $client_name = 'hh_client' `




## Returns




- ` TypecheckResult `
<!-- HHAPIDOC -->
