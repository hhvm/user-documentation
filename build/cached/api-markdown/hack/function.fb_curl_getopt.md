``` yamlmeta
{
    "name": "fb_curl_getopt",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php"
    ]
}
```




Gets options on the given cURL session handle




``` Hack
function fb_curl_getopt(
  resource $ch,
  int $opt = 0,
): mixed;
```




## Parameters




+ ` resource $ch ` - A cURL handle returned by curl_init().
+ ` int $opt = 0 ` - This should be one of the CURLOPT_* values.




## Returns




* ` mixed ` - - If opt is given, returns its value. Otherwise, returns an
  associative array.
<!-- HHAPIDOC -->
