The following example shows how to use `MCRouter::set` to set key/value pair to the memcached server. While you cannot `MCRouter::add` the same key twice, you can reset a value for a given key via `set`. It is quite possible to always use `set` instead of `add` since it is generally superset of functionality, but `add` can be good if you explicitly want to catch someone trying to set a key to a different value.

If you pass an expiration time for the key, that is in seconds.

And these are the bitwise or style flags that can be passed to `set`:

```
MC_MSG_FLAG_PHP_SERIALIZED = 0x1,
MC_MSG_FLAG_COMPRESSED = 0x2,
MC_MSG_FLAG_FB_SERIALIZED = 0x4,
MC_MSG_FLAG_FB_COMPACT_SERIALIZED = 0x8,
MC_MSG_FLAG_ASCII_INT_SERIALIZED = 0x10,
MC_MSG_FLAG_NZLIB_COMPRESSED = 0x800,
MC_MSG_FLAG_QUICKLZ_COMPRESSED = 0x2000,
MC_MSG_FLAG_SNAPPY_COMPRESSED = 0x4000,
MC_MSG_FLAG_BIG_VALUE = 0X8000,
MC_MSG_FLAG_NEGATIVE_CACHE = 0x10000,
MC_MSG_FLAG_HOT_KEY = 0x20000,
```

See the [header file with the flags](https://github.com/facebook/mcrouter/blob/5f259ed47b52f86cad750d2343edf324e80cb397/mcrouter/lib/mc/msg.h)
