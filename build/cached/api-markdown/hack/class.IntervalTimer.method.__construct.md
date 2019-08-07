``` yamlmeta
{
    "name": "__construct",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/intervaltimer/ext_intervaltimer.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_intervaltimer.hhi"
    ],
    "class": "IntervalTimer"
}
```




Create a new interval timer




``` Hack
public function __construct(
  double $interval,
  double $initial,
  mixed $callback,
);
```




## Parameters




+ ` double $interval ` - frequency in seconds of timer interrupts.
+ ` double $initial `
+ ` mixed $callback `
<!-- HHAPIDOC -->
