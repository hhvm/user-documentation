``` yamlmeta
{
    "name": "acquire",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/weakref/ext_weakref.php",
        "api-sources/hhvm/hphp/hack/hhi/weakref.hhi"
    ],
    "class": "WeakRef"
}
```




( excerpt from
http://php




``` Hack
public function acquire(): bool;
```




net/manual/en/weakref.acquire.php )




Acquires a strong reference on that object, virtually turning the weak
reference into a strong one.




## Returns




+ ` bool `
<!-- HHAPIDOC -->
