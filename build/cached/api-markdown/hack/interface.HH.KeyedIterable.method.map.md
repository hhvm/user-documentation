``` yamlmeta
{
    "name": "map",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values after an operation has been
applied to each value in the current `` KeyedIterable ``




``` Hack
public function map<Tu>(
  callable $fn,
): KeyedIterable<Tk, Tu>;
```




Every value in the current ` KeyedIterable ` is affected by a call to
`` map() ``, unlike ``` filter() ``` where only values that meet a certain criteria
are affected.




## Parameters




+ ` callable $fn ` - The callback containing the operation to apply to the
  `` KeyedIterable `` values.




## Returns




* ` KeyedIterable<Tk, Tu> ` - a `` KeyedIterable `` containing the values after a user-specified
  operation is applied.
<!-- HHAPIDOC -->
