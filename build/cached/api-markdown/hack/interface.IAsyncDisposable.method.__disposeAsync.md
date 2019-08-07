``` yamlmeta
{
    "name": "__disposeAsync",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Disposable.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "IAsyncDisposable"
}
```




This method is invoked exactly once at the end of the scope of the
await using statement, unless the program terminates with a fatal error




``` Hack
public function __disposeAsync(): Awaitable<void>;
```




## Returns




+ ` Awaitable<void> `
<!-- HHAPIDOC -->
