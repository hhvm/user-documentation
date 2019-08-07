``` yamlmeta
{
    "name": "takeWhile",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the keys and values of the current
`` ConstMap `` up to but not including the first value that produces ``` false ```
when passed to the specified callback




``` Hack
public function takeWhile(
  callable $fn,
): ConstMap<Tk, Tv>;
```




The returned ` ConstMap ` will always be a proper subset of the current
`` ConstMap ``.




## Parameters




+ ` callable $fn ` - The callback that is used to determine the stopping condition.




## Returns




* ` ConstMap<Tk, Tv> ` - A `` ConstMap `` that is a proper subset of the current ``` ConstMap ```
  up until the callback returns ```` false ````.
<!-- HHAPIDOC -->
