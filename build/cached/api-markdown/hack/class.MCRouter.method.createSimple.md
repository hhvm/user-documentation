``` yamlmeta
{
    "name": "createSimple",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Simplified constructor







``` Hack
public static function createSimple(
  Vector $servers,
): MCRouter;
```




## Parameters




+ ` Vector $servers ` - List of memcache servers to connect to




## Returns




* ` MCRouter ` - Instance of MCRouter




## Examples




The following example shows you how use ` MCRouter::createSimple ` to create an instance of `` MCRouter ``. You only need to pass it a ``` Vector ``` containing one or more locations of Memcached servers; default configurations are used after that (e.g, ```` route = 'PoolRoute|P' ````).







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/createSimple/001-basic-usage.php @@
<!-- HHAPIDOC -->
