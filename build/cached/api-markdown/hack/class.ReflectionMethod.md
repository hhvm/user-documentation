``` yamlmeta
{
    "name": "ReflectionMethod",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/reflection/ext_reflection_hni.php",
        "api-sources/hhvm/hphp/hack/hhi/reflection.hhi"
    ],
    "class": "ReflectionMethod"
}
```




( excerpt from http://php




net/manual/en/class.reflectionmethod.php )




The ReflectionMethod class reports information about a method.




## Interface Synopsis




``` Hack
class ReflectionMethod extends ReflectionFunctionAbstract implements Reflector {...}
```




### Public Methods




+ [` ::export(string $class, string $name, bool $return = false): ?string `](</hack/reference/class/ReflectionMethod/export/>)\
  ( excerpt from http://php
+ [` ->__construct(...$class) `](</hack/reference/class/ReflectionMethod/__construct/>)\
  ( excerpt from http://php
+ [` ->__debuginfo() `](</hack/reference/class/ReflectionMethod/__debuginfo/>)
+ [` ->__toString(): string `](</hack/reference/class/ReflectionMethod/__toString/>)\
  ( excerpt from http://php
+ [` ->getAttributeClass<T as HH\MethodAttribute>(classname<T> $c): ?T `](</hack/reference/class/ReflectionMethod/getAttributeClass/>)
+ [` ->getAttributeRecursive(string $name): ?varray<mixed> `](</hack/reference/class/ReflectionMethod/getAttributeRecursive/>)
+ [` ->getAttributesRecursive(): darray<string, varray<mixed>, arraykey, array<int, mixed>> `](</hack/reference/class/ReflectionMethod/getAttributesRecursive/>)
+ [` ->getClosure($object = NULL): ?Closure `](</hack/reference/class/ReflectionMethod/getClosure/>)\
  ( excerpt from http://php
+ [` ->getDeclaringClass() `](</hack/reference/class/ReflectionMethod/getDeclaringClass/>)\
  ( excerpt from
  http://php
+ [` ->getModifiers(): int `](</hack/reference/class/ReflectionMethod/getModifiers/>)\
  ( excerpt from
  http://php
+ [` ->getPrototype(): ReflectionMethod `](</hack/reference/class/ReflectionMethod/getPrototype/>)\
  ( excerpt from
  http://php
+ [` ->invoke($obj, ...$args): mixed `](</hack/reference/class/ReflectionMethod/invoke/>)\
  ( excerpt from http://php
+ [` ->invokeArgs($obj, varray $args): mixed `](</hack/reference/class/ReflectionMethod/invokeArgs/>)\
  ( excerpt from http://php
+ [` ->isAbstract(): bool `](</hack/reference/class/ReflectionMethod/isAbstract/>)\
  ( excerpt from http://php
+ [` ->isConstructor(): bool `](</hack/reference/class/ReflectionMethod/isConstructor/>)\
  ( excerpt from
  http://php
+ [` ->isFinal(): bool `](</hack/reference/class/ReflectionMethod/isFinal/>)\
  ( excerpt from http://php
+ [` ->isPrivate(): bool `](</hack/reference/class/ReflectionMethod/isPrivate/>)\
  ( excerpt from http://php
+ [` ->isProtected(): bool `](</hack/reference/class/ReflectionMethod/isProtected/>)\
  ( excerpt from http://php
+ [` ->isPublic(): bool `](</hack/reference/class/ReflectionMethod/isPublic/>)\
  ( excerpt from http://php
+ [` ->isStatic(): bool `](</hack/reference/class/ReflectionMethod/isStatic/>)\
  ( excerpt from http://php
+ [` ->setAccessible(bool $accessible): void `](</hack/reference/class/ReflectionMethod/setAccessible/>)\
  ( excerpt from
  http://php







### Private Methods




* [` ->__init(mixed $cls_or_obj, string $meth): bool `](</hack/reference/class/ReflectionMethod/__init/>)
* [` ->getDeclaringClassname(): string `](</hack/reference/class/ReflectionMethod/getDeclaringClassname/>)
* [` ->getPrototypeClassname(): string `](</hack/reference/class/ReflectionMethod/getPrototypeClassname/>)
* [` ->isAccessible(): bool `](</hack/reference/class/ReflectionMethod/isAccessible/>)
* [` ->isStaticInPrologue(): bool `](</hack/reference/class/ReflectionMethod/isStaticInPrologue/>)
* [` ->validateInvokeParameters($obj, $args): mixed `](</hack/reference/class/ReflectionMethod/validateInvokeParameters/>)
<!-- HHAPIDOC -->
