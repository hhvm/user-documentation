``` yamlmeta
{
    "name": "HH\\Asio\\backtrace",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_asio.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_asio.hhi"
    ]
}
```




Generates a backtrace for $awaitable




``` Hack
namespace HH\Asio;

function backtrace<\T>(
  Awaitable<\T, \mixed> $awaitable,
  int $options = \DEBUG_BACKTRACE_PROVIDE_OBJECT,
  int $limit = 0,
): \varray<darray>;
```




Following conditions must be met to produce non-empty backtrace:

+ $awaitable has not finished yet (i.e. has_finished($awaitable) === false)
+ $awaitable is part of valid scheduler context
  (i.e. $awaitable->getContextIdx() > 0)
  If either condition is not met, backtrace() returns empty array.




## Parameters




* ` Awaitable<\T, \mixed> $awaitable ` - Awaitable, to take backtrace from.
* ` int $options = \DEBUG_BACKTRACE_PROVIDE_OBJECT ` - bitmask of the following options:
  DEBUG_BACKTRACE_PROVIDE_OBJECT
  DEBUG_BACKTRACE_PROVIDE_METADATA
  DEBUG_BACKTRACE_IGNORE_ARGS
* ` int $limit = 0 ` - the maximum number of stack frames returned.
  By default (limit=0) it returns all stack frames.




## Returns




- ` array ` - - Returns an array of associative arrays.
  See debug_backtrace() for detailed format description.
<!-- HHAPIDOC -->
