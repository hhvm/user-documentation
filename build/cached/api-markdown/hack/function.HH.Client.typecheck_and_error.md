``` yamlmeta
{
    "name": "HH\\Client\\typecheck_and_error",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/hh_client/ext_hh_client.php"
    ]
}
```




This is deliberately an unconfigurable convenience wrapper




``` Hack
namespace HH\Client;

function typecheck_and_error(): \void;
```




If you want
full configurability, call typecheck() and use the TypecheckResult
yourself.




## Returns




+ ` \void `
<!-- HHAPIDOC -->
