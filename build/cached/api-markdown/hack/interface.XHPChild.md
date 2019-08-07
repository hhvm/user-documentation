``` yamlmeta
{
    "name": "XHPChild",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/string.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "XHPChild"
}
```




XHPChild is the base type of values that can be children of XHP elements




Most primitive types implement XHPChild: string, int, float, and array.




Classes that implement XHPChild must do so by implementing the XHPChildClass
subinterface.




## Interface Synopsis




``` Hack
interface XHPChild {...}
```



<!-- HHAPIDOC -->
