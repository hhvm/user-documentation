``` yamlmeta
{
    "name": "MCRouter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




## Interface Synopsis




``` Hack
class MCRouter {...}
```




### Public Methods




+ [` ::createSimple(Vector $servers): MCRouter `](</hack/reference/class/MCRouter/createSimple/>)\
  Simplified constructor

+ [` ::getOpName(int $op): string `](</hack/reference/class/MCRouter/getOpName/>)\
  Translate an mc_op_* numeric code to something human-readable

+ [` ::getResultName(int $op): string `](</hack/reference/class/MCRouter/getResultName/>)\
  Translate an mc_res_* numeric code to something human-readable

+ [` ->__construct(array<string, mixed> $options, string $pid = ''): void `](</hack/reference/class/MCRouter/__construct/>)\
  Initialize an MCRouter handle

+ [` ->add(string $key, string $value, int $flags = 0, int $expiration = 0): Awaitable<void> `](</hack/reference/class/MCRouter/add/>)\
  Store a value

+ [` ->append(string $key, string $value): Awaitable<void> `](</hack/reference/class/MCRouter/append/>)\
  Modify a value

+ [` ->cas(int $cas, string $key, string $value, int $expiration = 0): Awaitable<void> `](</hack/reference/class/MCRouter/cas/>)\
  Compare and set

+ [` ->decr(string $key, int $val): Awaitable<int> `](</hack/reference/class/MCRouter/decr/>)\
  Atomicly decrement a numeric value

+ [` ->del(string $key): Awaitable<void> `](</hack/reference/class/MCRouter/del/>)\
  Delete a key

+ [` ->flushAll(int $delay = 0): Awaitable<void> `](</hack/reference/class/MCRouter/flushAll/>)\
  Flush all key/value pairs

+ [` ->get(string $key): Awaitable<string> `](</hack/reference/class/MCRouter/get/>)\
  Retreive a value

+ [` ->gets(string $key): Awaitable<array> `](</hack/reference/class/MCRouter/gets/>)\
  Retreive a record and its metadata

+ [` ->incr(string $key, int $val): Awaitable<int> `](</hack/reference/class/MCRouter/incr/>)\
  Atomicly increment a numeric value

+ [` ->prepend(string $key, string $value): Awaitable<void> `](</hack/reference/class/MCRouter/prepend/>)\
  Modify a value

+ [` ->replace(string $key, string $value, int $flags = 0, int $expiration = 0): Awaitable<void> `](</hack/reference/class/MCRouter/replace/>)\
  Store a value

+ [` ->set(string $key, string $value, int $flags = 0, int $expiration = 0): Awaitable<void> `](</hack/reference/class/MCRouter/set/>)\
  Store a value (replacing if present)

+ [` ->version(): Awaitable<string> `](</hack/reference/class/MCRouter/version/>)\
  Get the remote server's current version




<!-- HHAPIDOC -->
