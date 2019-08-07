``` yamlmeta
{
    "name": "raise",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_async-generator.php",
        "api-sources/hhvm/hphp/hack/hhi/classes.hhi"
    ],
    "class": "HH\\AsyncGenerator"
}
```




Raise an exception to the async generator




``` Hack
public function raise(
  Exception $exception,
): Awaitable<?tuple<Tk, Tv>>;
```




You should always ` await ` the returned `` Awaitable `` to get the actual
key/value tuple.




If ` null ` is returned, that means you have reached the end of iteration.




You cannot call ` raise() ` without having the value returned from a previous
call to `` raise() ``, ``` next() ```, ```` send() ````, having first ````` await `````ed.




## Parameters




+ ` Exception $exception `




## Returns




* ` Awaitable<?tuple<Tk, Tv>> ` - The `` Awaitable `` that produced the yielded key/value tuple after
  the exception is processed. What is returned is a tuple or
  ``` null ```.
<!-- HHAPIDOC -->
