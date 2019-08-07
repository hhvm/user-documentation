``` yamlmeta
{
    "name": "IDisposable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Disposable.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "IDisposable"
}
```




Objects that implement IDisposable may be used in using statements




## Interface Synopsis




``` Hack
interface IDisposable {...}
```




### Public Methods




+ [` ->__dispose(): void `](</hack/reference/interface/IDisposable/__dispose/>)\
  This method is invoked exactly once at the end of the scope of the
  using statement, unless the program terminates with a fatal error
<!-- HHAPIDOC -->
