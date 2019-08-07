``` yamlmeta
{
    "name": "filterWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values of the current
`` KeyedIterable `` that meet a supplied condition applied to its keys and
values




``` Hack
public function filterWithKey(
  callable $callback,
):     KeyedIterable<Tk, Tv>;
```




Only keys and values that meet a certain criteria are affected by a call to
` filterWithKey() `, while all values are affected by a call to
`` mapWithKey() ``.




## Parameters




+ ` callable $callback `




## Returns




* ` KeyedIterable<Tk, Tv> ` - a `` KeyedIterable `` containing the values after a user-specified
  condition is applied to the keys and values of the current
  ``` KeyedIterable ```.
<!-- HHAPIDOC -->
