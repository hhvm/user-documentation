``` yamlmeta
{
    "name": "IAsyncDisposable",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Disposable.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "IAsyncDisposable"
}
```




Objects that implement IAsyncDisposable may be used in await using statements




## Interface Synopsis




``` Hack
interface IAsyncDisposable {...}
```




### Public Methods




+ [` ->__disposeAsync(): Awaitable<void> `](</hack/reference/interface/IAsyncDisposable/__disposeAsync/>)\
  This method is invoked exactly once at the end of the scope of the
  await using statement, unless the program terminates with a fatal error
<!-- HHAPIDOC -->
