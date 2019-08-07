``` yamlmeta
{
    "name": "next",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_async-generator.php",
        "api-sources/hhvm/hphp/hack/hhi/classes.hhi"
    ],
    "class": "HH\\AsyncGenerator"
}
```




Return the ` Awaitable ` associated with the next key/value tuple in the
async generator, or `` null ``




``` Hack
public function next(): Awaitable<?tuple<Tk, Tv>>;
```




You should always ` await ` the returned `` Awaitable `` to get the actual
key/value tuple.




If ` null ` is returned, that means you have reached the end of iteration.




You cannot call ` next() ` without having the value returned from a previous
call to `` next() ``, ``` send() ```, ```` raise() ````, having first ````` await `````ed.




## Returns




+ ` Awaitable<?tuple<Tk, Tv>> ` - The `` Awaitable `` that produced the next key/value tuple in the
  generator. What is returned is a tuple or ``` null ```.
<!-- HHAPIDOC -->
