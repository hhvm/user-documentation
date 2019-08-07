``` yamlmeta
{
    "name": "HH\\xenon_get_data",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/xenon/ext_xenon.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_xenon.hhi"
    ]
}
```




Gather all of the stack traces this request thread has captured by now




``` Hack
namespace HH;

function xenon_get_data(): \varray<XenonSample>;
```




Does not clear the stored stacks.




## Returns




+ ` array ` - - an array of shapes with the following keys:
  'time' - unixtime when the snapshot was taken
  'stack' - stack trace formatted as debug_backtrace()
  'phpStack' - an array of shapes with the following keys:
  'function', 'file', 'line'
  'ioWaitSample' - the snapshot occurred while request was in asio scheduler




It is possible for the output of this function to change in the future.
<!-- HHAPIDOC -->
