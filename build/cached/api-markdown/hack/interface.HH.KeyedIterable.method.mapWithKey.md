``` yamlmeta
{
    "name": "mapWithKey",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns a ` KeyedIterable ` containing the values after an operation has
been applied to each key and value in the current `` KeyedIterable ``




``` Hack
public function mapWithKey<Tu>(
  callable $callback,
):     KeyedIterable<Tk, Tu>;
```




Every key and value in the current ` KeyedIterable ` is affected by a call to
`` mapWithKey() ``, unlike ``` filterWithKey() ``` where only values that meet a
certain criteria are affected.




## Parameters




+ ` callable $callback `




## Returns




* ` KeyedIterable<Tk, Tu> ` - a `` KeyedIterable `` containing the values after a user-specified
  operation on the current ``` KeyedIterable ```'s keys and values is
  applied.
<!-- HHAPIDOC -->
