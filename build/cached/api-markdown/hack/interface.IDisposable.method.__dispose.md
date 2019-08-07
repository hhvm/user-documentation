``` yamlmeta
{
    "name": "__dispose",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Disposable.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "IDisposable"
}
```




This method is invoked exactly once at the end of the scope of the
using statement, unless the program terminates with a fatal error




``` Hack
public function __dispose(): void;
```




## Returns




+ ` void `
<!-- HHAPIDOC -->
