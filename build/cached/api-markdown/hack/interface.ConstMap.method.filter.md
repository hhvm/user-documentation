``` yamlmeta
{
    "name": "filter",
    "sources": [
        "api-sources/hhvm/hphp/system/php/collections/collections.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/collections/interfaces.hhi"
    ],
    "class": "ConstMap"
}
```




Returns a ` ConstMap ` containing the values of the current `` ConstMap `` that
meet a supplied condition




``` Hack
public function filter(
  callable $fn,
): ConstMap<Tk, Tv>;
```




Only values that meet a certain criteria are affected by a call to
` filter() `, while all values are affected by a call to `` map() ``.




The keys associated with the current ` ConstMap ` remain unchanged in the
returned `` ConstMap ``.




## Parameters




+ ` callable $fn ` - The callback containing the condition to apply to the current
  `` ConstMap `` values.




## Returns




* ` ConstMap<Tk, Tv> ` - a Map containing the values after a user-specified condition
  is applied.
<!-- HHAPIDOC -->
