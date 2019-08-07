``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values of the current
`` KeyedIterable `` that meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): KeyedIterable<Tk, Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the
  `` KeyedItearble `` values.




## Returns




* ` KeyedIterable<Tk, Tv> ` - a `` KeyedIterable `` containing the values after a user-specified
  condition is applied.
<!-- HHAPIDOC -->
