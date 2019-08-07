``` yamlmeta
{
    "name": "HH\\curl_init_pooled",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_curl.hhi"
    ]
}
```




Initialize a cURL session using a pooled curl handle




``` Hack
namespace HH;

function curl_init_pooled(
  string $pool_name,
  string $url = NULL,
): \mixed;
```




When this resource
is garbage collected, the curl handle will be saved for reuse later.
Pooled curl handles persist between requests.




## Parameters




+ ` string $pool_name `
+ ` string $url = NULL ` - If provided, the CURLOPT_URL option will be set
  to its value. You can manually set this using the curl_setopt()
  function.    The file protocol is disabled by cURL if open_basedir is
  set.




## Returns




* ` resource ` - - Returns a cURL handle on success, FALSE on errors.
<!-- HHAPIDOC -->
