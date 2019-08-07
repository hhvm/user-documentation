``` yamlmeta
{
    "name": "curl_multi_await",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/curl/ext_curl.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_curl.hhi"
    ]
}
```




The async equivalent to
[` curl_multi_select `](http://php




``` Hack
function curl_multi_await(
  resource $mh,
  float $timeout = 1,
): Awaitable<int>;
```




net/manual/en/function.curl-multi-select.php)




This function waits until there is activity on a cURL handle within ` $mh `.
Once there is activity, you process the result with
[` curl_multi_exec `](<http://php.net/manual/en/function.curl-multi-exec.php>)




## Parameters




+ ` resource $mh ` - A cURL multi handle returned from
  [` curl_multi_init `](<http://php.net/manual/en/function.curl-multi-init.php>).
+ ` float $timeout = 1 ` - The time to wait for a response indicating some activity.




## Returns




* ` Awaitable<int> ` - - An `` Awaitable `` representing the ``` int ``` result of the
  activity. If returned ```` int ```` is positive, that
  represents the number of handles on which there
  was activity. If ````` 0 `````, that means no activity
  occurred. If negative, then there was a select
  failure.




## Examples




The following shows a scenario where you are going to wait for and return the result of activity on multiple curl handles. A bit of a simpler approach would be to use [` HH\Asio\curl_exec `](<//hack/reference/function/HH.Asio.curl_exec/>), which is a wrapper around `` curl_multi_await ``.







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/function.curl_multi_await/001-basic-usage.php @@
<!-- HHAPIDOC -->
