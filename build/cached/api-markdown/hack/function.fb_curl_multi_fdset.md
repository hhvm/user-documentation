``` yamlmeta
{
    "name": "fb_curl_multi_fdset",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php"
    ]
}
```




extracts file descriptor information from a multi handle




``` Hack
function fb_curl_multi_fdset(
  resource $mh,
  array& &$read_fd_set,
  array& &$write_fd_set,
  array& &$exc_fd_set,
  int& &$max_fd = NULL,
): mixed;
```




## Parameters




+ ` resource $mh ` - A cURL multi handle returned by
  curl_multi_init().
+ ` array& &$read_fd_set ` - read set
+ ` array& &$write_fd_set ` - write set
+ ` array& &$exc_fd_set ` - exception set
+ ` int& &$max_fd = NULL ` - If no file descriptors are set, $max_fd will
  contain -1. Otherwise it will contain the higher descriptor number.




## Returns




* ` mixed ` - - Returns 0 on success, or one of the CURLM_XXX errors code.
<!-- HHAPIDOC -->
