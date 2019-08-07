``` yamlmeta
{
    "name": "send",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_async-generator.php",
        "api-sources/hhvm/hphp/hack/hhi/classes.hhi"
    ],
    "class": "HH\\AsyncGenerator"
}
```




Send a value to the async generator and resumes execution of the generator




``` Hack
public function send(
  ?Ts $value,
): Awaitable<?tuple<Tk, Tv>>;
```




You should always ` await ` the returned `` Awaitable `` to get the actual
key/value tuple.




If ` null ` is returned, that means you have reached the end of iteration.




You cannot call ` send() ` without having the value returned from a previous
call to `` send() ``, ``` next() ```, ```` raise() ````, having first ````` await `````ed.




If you pass ` null ` to `` send() ``, that is equivalent to calling ``` next() ```,
but you still need an initial ```` next() ```` call before calling ````` send(null) `````.




## Parameters




+ ` ?Ts $value `




## Returns




* ` Awaitable<?tuple<Tk, Tv>> ` - The `` Awaitable `` that produced the yielded key/value tuple in
  the generator. What is returned is a tuple or ``` null ```.
<!-- HHAPIDOC -->
