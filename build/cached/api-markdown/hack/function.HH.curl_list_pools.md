``` yamlmeta
{
    "name": "HH\\curl_list_pools",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php"
    ]
}
```




Lists currently available cURL connection pools and their configuration




``` Hack
namespace HH;

function curl_list_pools(): \darray<string, darray>;
```




## Returns




+ ` array `
<!-- HHAPIDOC -->
