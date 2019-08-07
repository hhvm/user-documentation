``` yamlmeta
{
    "name": "ReflectionParameter",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection-classes.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionParameter"
}
```




( excerpt from http://php




net/manual/en/class.reflectionparameter.php )




The ReflectionParameter class retrieves information about function's or
method's parameters.




To introspect function parameters, first create an instance of the
ReflectionFunction or ReflectionMethod classes and then use their
ReflectionFunctionAbstract::getParameters() method to retrieve an array
of parameters.




## Interface Synopsis




``` Hack
class ReflectionParameter implements Reflector {...}
```




### Public Methods




+ [` ::export($function, $parameter, $return = false) `](</hack/reference/class/ReflectionParameter/export/>)\
  ( excerpt from http://php
+ [` ->__construct($function, $parameter) `](</hack/reference/class/ReflectionParameter/__construct/>)\
  ( excerpt from
  http://php
+ [` ->__toString() `](</hack/reference/class/ReflectionParameter/__toString/>)\
  ( excerpt from http://php
+ [` ->allowsNull() `](</hack/reference/class/ReflectionParameter/allowsNull/>)\
  ( excerpt from
  http://php
+ [` ->canBePassedByValue() `](</hack/reference/class/ReflectionParameter/canBePassedByValue/>)\
  ( excerpt from
  http://php
+ [` ->getAttribute(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionParameter/getAttribute/>)
+ [` ->getAttributeClass<T as HH\ParameterAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionParameter/getAttributeClass/>)
+ [` ->getAttributeRecursive(string $name) `](</hack/reference/class/ReflectionParameter/getAttributeRecursive/>)
+ [` ->getAttributes(): darray<string, varray<mixed>> `](</hack/reference/class/ReflectionParameter/getAttributes/>)
+ [` ->getAttributesNamespaced() `](</hack/reference/class/ReflectionParameter/getAttributesNamespaced/>)
+ [` ->getAttributesRecursive() `](</hack/reference/class/ReflectionParameter/getAttributesRecursive/>)
+ [` ->getClass() `](</hack/reference/class/ReflectionParameter/getClass/>)\
  ( excerpt from http://php
+ [` ->getDeclaringClass() `](</hack/reference/class/ReflectionParameter/getDeclaringClass/>)\
  ( excerpt from
  http://php
+ [` ->getDeclaringFunction() `](</hack/reference/class/ReflectionParameter/getDeclaringFunction/>)\
  ( excerpt from
  http://php
+ [` ->getDefaultValue() `](</hack/reference/class/ReflectionParameter/getDefaultValue/>)\
  ( excerpt from
  http://php
+ [` ->getDefaultValueConstantName() `](</hack/reference/class/ReflectionParameter/getDefaultValueConstantName/>)\
  ( excerpt from
  php
+ [` ->getDefaultValueText() `](</hack/reference/class/ReflectionParameter/getDefaultValueText/>)\
  This is an HHVM only function that gets the raw text associated with
  a default parameter
+ [` ->getName() `](</hack/reference/class/ReflectionParameter/getName/>)\
  ( excerpt from http://php
+ [` ->getPosition() `](</hack/reference/class/ReflectionParameter/getPosition/>)\
  ( excerpt from
  http://php
+ [` ->getType(): ?ReflectionType `](</hack/reference/class/ReflectionParameter/getType/>)\
  ( excerpt from
  http://php
+ [` ->getTypeText(): string `](</hack/reference/class/ReflectionParameter/getTypeText/>)
+ [` ->getTypehintText() `](</hack/reference/class/ReflectionParameter/getTypehintText/>)
+ [` ->hasType(): bool `](</hack/reference/class/ReflectionParameter/hasType/>)\
  ( excerpt from
  http://php
+ [` ->isArray() `](</hack/reference/class/ReflectionParameter/isArray/>)\
  ( excerpt from http://php
+ [` ->isCallable() `](</hack/reference/class/ReflectionParameter/isCallable/>)\
  ( excerpt from
  http://php
+ [` ->isDefaultValueAvailable() `](</hack/reference/class/ReflectionParameter/isDefaultValueAvailable/>)\
  ( excerpt from
  http://php
+ [` ->isDefaultValueConstant(): ?bool `](</hack/reference/class/ReflectionParameter/isDefaultValueConstant/>)\
  ( excerpt from
  http://php
+ [` ->isInOut(): bool `](</hack/reference/class/ReflectionParameter/isInOut/>)\
  Checks if this is an inout parameter
+ [` ->isOptional(): bool `](</hack/reference/class/ReflectionParameter/isOptional/>)\
  ( excerpt from
  http://php
+ [` ->isPassedByReference() `](</hack/reference/class/ReflectionParameter/isPassedByReference/>)\
  ( excerpt from
  http://php
+ [` ->isVariadic(): bool `](</hack/reference/class/ReflectionParameter/isVariadic/>)\
  Checks if the parameter is variadic







### Private Methods




* [` ::collectAttributes(&$attrs, $class, $function_name, $index) `](</hack/reference/class/ReflectionParameter/collectAttributes/>)
* [` ->__clone() `](</hack/reference/class/ReflectionParameter/__clone/>)
<!-- HHAPIDOC -->
