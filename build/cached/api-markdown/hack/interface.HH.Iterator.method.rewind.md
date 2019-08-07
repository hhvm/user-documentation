``` yamlmeta
{
    "name": "rewind",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/Iterator.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\Iterator"
}
```




( excerpt from http://php




``` Hack
public function rewind(): void;
```




net/manual/en/iterator.rewind.php )




Rewinds back to the first element of the Iterator.




This is the first method called when starting a foreach loop. It will
not be executed after foreach loops.




## Returns




+ ` mixed ` - Any returned value is ignored.
<!-- HHAPIDOC -->
