``` yamlmeta
{
    "name": "pagelet_server_task_start",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_server.hhi"
    ]
}
```




Processes a pagelet server request




``` Hack
function pagelet_server_task_start(
  string $url,
  array $headers = array (
),
  string $post_data = '',
  array $files = array (
),
  int $timeout_seconds = 0,
): resource;
```




## Parameters




+ ` string $url ` - The URL we're running this pagelet with.
+ ` array $headers = array ( ) ` - HTTP headers to send to the pagelet.
+ ` string $post_data = '' ` - POST data to send.
+ ` array $files = array ( ) ` - Array for the pagelet.
+ ` int $timeout_seconds = 0 `




## Returns




* ` resource ` - - An object that can be used with
  pagelet_server_task_status() or pagelet_server_task_result().
<!-- HHAPIDOC -->
