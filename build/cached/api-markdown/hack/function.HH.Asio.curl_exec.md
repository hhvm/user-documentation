``` yamlmeta
{
    "name": "HH\\Asio\\curl_exec",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_curl.hhi"
    ]
}
```




A convenience wrapper around
[` curl_multi_await `](</hack/reference/function/curl_multi_await/>)




``` Hack
namespace HH\Asio;

function curl_exec(
  \mixed $url_or_handle,
): Awaitable<string>;
```




Pass a cURL handle, or, more simply, a string containing a URL (and the
cURL handle will be created for you), and the cURL request will be executed
via async and the ` string ` result will be returned.




curl_multi_info_read must be used to retrieve error information,
curl_errno can't be used as this function is a wrapper to curl_multi_await.




## Parameters




+ ` \mixed $url_or_handle `




## Returns




* ` Awaitable<string> ` - - An `` Awaitable `` representing the ``` string ``` result
  of the cURL request.




## Examples




The following shows a scenario where you are going to wait for and return the result of cURL activity on URLs, using the convenient wrapper that is ` curl_exec `.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.HH.Asio.curl_exec/001-basic-usage.php @@
<!-- HHAPIDOC -->
