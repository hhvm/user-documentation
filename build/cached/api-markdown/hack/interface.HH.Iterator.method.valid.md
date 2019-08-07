``` yamlmeta
{
    "name": "valid",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Iterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterator"
}
```




( excerpt from http://php




``` Hack
public function valid(): bool;
```




net/manual/en/iterator.valid.php )




This method is called after Iterator::rewind() and Iterator::next() to
check if the current position is valid.




## Returns




+ ` mixed ` - The return value will be casted to boolean and then
  evaluated. Returns TRUE on success or FALSE on
  failure.
<!-- HHAPIDOC -->
