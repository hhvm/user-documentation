``` yamlmeta
{
    "name": "ReflectionFunction",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionFunction"
}
```




( excerpt from http://php




net/manual/en/class.reflectionfunction.php )




The ReflectionFunction class reports information about a function.




## Interface Synopsis




``` Hack
class ReflectionFunction extends ReflectionFunctionAbstract implements Reflector {...}
```




### Public Methods




+ [` ::export($name, $return = false) `](</hack/reference/class/ReflectionFunction/export/>)\
  ( excerpt from http://php
+ [` ->__construct($name_or_closure) `](</hack/reference/class/ReflectionFunction/__construct/>)\
  ( excerpt from http://php
+ [` ->__toString(): string `](</hack/reference/class/ReflectionFunction/__toString/>)\
  ( excerpt from http://php
+ [` ->getAttributeClass<T as HH\FunctionAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionFunction/getAttributeClass/>)
+ [` ->getClosure() `](</hack/reference/class/ReflectionFunction/getClosure/>)
+ [` ->getClosureScopeClass(): ?ReflectionClass `](</hack/reference/class/ReflectionFunction/getClosureScopeClass/>)
+ [` ->getClosureThis(): mixed `](</hack/reference/class/ReflectionFunction/getClosureThis/>)\
  Returns this pointer bound to closure
+ [` ->getName(): string `](</hack/reference/class/ReflectionFunction/getName/>)\
  (excerpt from
  http://php
+ [` ->invoke(...$args) `](</hack/reference/class/ReflectionFunction/invoke/>)\
  ( excerpt from http://php
+ [` ->invokeArgs(varray $args) `](</hack/reference/class/ReflectionFunction/invokeArgs/>)\
  ( excerpt from
  http://php
+ [` ->isClosure(): bool `](</hack/reference/class/ReflectionFunction/isClosure/>)
+ [` ->isDisabled(): bool `](</hack/reference/class/ReflectionFunction/isDisabled/>)\
  ( excerpt from
  http://php







### Private Methods




* [` ->__initClosure(object $closure): bool `](</hack/reference/class/ReflectionFunction/__initClosure/>)
* [` ->__initName(string $name): bool `](</hack/reference/class/ReflectionFunction/__initName/>)
* [` ->getClosureScopeClassname(object $closure): ?string `](</hack/reference/class/ReflectionFunction/getClosureScopeClassname/>)
* [` ->getClosureThisObject(object $closure): ?object `](</hack/reference/class/ReflectionFunction/getClosureThisObject/>)
<!-- HHAPIDOC -->
