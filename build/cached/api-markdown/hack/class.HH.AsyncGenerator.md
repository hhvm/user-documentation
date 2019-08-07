``` yamlmeta
{
    "name": "HH\\AsyncGenerator",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/asio/ext_async-generator.php",
        "api-sources/hhvm/hphp/hack/hhi/classes.hhi"
    ],
    "class": "HH\\AsyncGenerator"
}
```




Async generators are similar to
[PHP Generators](http://php




net/manual/en/language.generators.overview.php),
except that we are combining async with generators.




An async generator is just like a normal generator with the addition of
allowing ` await ` statements in it because getting to the next yielded value
involves getting and awaiting on an `` Awaitable ``.




WHILE THIS CLASS EXPOSES 3 METHODS, 99.9% OF THE TIME YOU WILL NOT USE THIS
CLASS DIRECTLY. INSTEAD, YOU WILL USE ` await as ` IN THE CODE USING YOUR
ASYNC GENERATOR. PLEASE READ THE GUIDE REFERENCED IN THIS API DOCUMENTATION
FOR MORE INFORMATION. However, we document these methods for completeness in
case you have a use case for them.




There are three type parameters associated with an AsyncGenerator:

+ ` Tk `: The type of key returned by the generator
+ ` Tv `: The type of value returned by the generator
+ ` Ts `: The type that will be passed on a call to `` send() ``




## Interface Synopsis




``` Hack
namespace HH;

final class AsyncGenerator implements AsyncKeyedIterator {...}
```




### Public Methods




* [` ->next(): Awaitable<?\tuple<\Tk, \Tv>> `](</hack/reference/class/HH.AsyncGenerator/next/>)\
  Return the `` Awaitable `` associated with the next key/value tuple in the
  async generator, or ``` null ```
* [` ->raise(\Exception $exception): Awaitable<?\tuple<\Tk, \Tv>> `](</hack/reference/class/HH.AsyncGenerator/raise/>)\
  Raise an exception to the async generator
* [` ->send(?\Ts $value): Awaitable<?\tuple<\Tk, \Tv>> `](</hack/reference/class/HH.AsyncGenerator/send/>)\
  Send a value to the async generator and resumes execution of the generator







### Private Methods




- [` ->__construct(): \void `](</hack/reference/class/HH.AsyncGenerator/__construct/>)
<!-- HHAPIDOC -->
