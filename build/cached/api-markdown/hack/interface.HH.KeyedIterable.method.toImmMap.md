``` yamlmeta
{
    "name": "toImmMap",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/KeyedIterable.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/interfaces.hhi"
    ],
    "class": "HH\\KeyedIterable"
}
```




Returns an immutable map (` ImmMap `) based on the keys and values of the
current `` KeyedIterable ``




``` Hack
public function toImmMap(): ImmMap<Tk, Tv>;
```




## Returns




+ ` ImmMap<Tk, Tv> ` - an `` ImmMap `` that has the keys and associated values of the
  current ``` KeyedIterable ```.
<!-- HHAPIDOC -->
