``` yamlmeta
{
    "name": "HH\\get_headers_secure",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/apache/ext_apache.php"
    ]
}
```




Fetch all HTTP request headers, including duplicates







``` Hack
namespace HH;

function get_headers_secure(): \darray<string, \varray<string>>;
```




## Returns




+ ` array ` - - An associative array of all the HTTP headers in the
  current request. The values in the array will be strings for uniquely
  specified headers, but arrays where a header was specified more than once.
<!-- HHAPIDOC -->
