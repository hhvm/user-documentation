``` yamlmeta
{
    "name": "HH\\server_is_prepared_to_stop",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/server/ext_server.php"
    ]
}
```




Whether the server is prepared to stop




``` Hack
namespace HH;

function server_is_prepared_to_stop(): bool;
```




This is different from
'server_is_stopping', because the server has not received the 'stop' command,
and is not scheduled to stop.  It is still fully functional, able to handle
requests for an indefinite amount of time, and should be considered healthy.
This is just a hint used during server update.




## Returns




+ ` bool ` - - True if server has received 'prepare-to-stop' command from the
  admin port in the past 'RuntimeOption::ServerPrepareToStop' seconds; False
  if server is not running, or has not received instructions to prepare to
  stop.
<!-- HHAPIDOC -->
