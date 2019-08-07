``` yamlmeta
{
    "name": "release",
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
public function release(): bool;
```




net/manual/en/weakref.release.php )




Releases a previously acquired reference, potentially turning a strong
reference back into a weak reference.




## Returns




+ ` bool `
<!-- HHAPIDOC -->
