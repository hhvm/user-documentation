``` yamlmeta
{
    "name": "IntervalTimer",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/intervaltimer/ext_intervaltimer.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_intervaltimer.hhi"
    ],
    "class": "IntervalTimer"
}
```




A timer that periodically interrupts a request thread




## Interface Synopsis




``` Hack
class IntervalTimer {...}
```




### Public Methods




+ [` ->__construct(double $interval, double $initial, mixed $callback) `](</hack/reference/class/IntervalTimer/__construct/>)\
  Create a new interval timer
+ [` ->start(): void `](</hack/reference/class/IntervalTimer/start/>)\
  Start the timer
+ [` ->stop(): void `](</hack/reference/class/IntervalTimer/stop/>)\
  Stop the timer
<!-- HHAPIDOC -->
