``` yamlmeta
{
    "name": "HH\\class_meth",
    "sources": [
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Create a function reference to a static method on a class




``` Hack
namespace HH;

function class_meth(
  string $cls_name,
  string $meth_name,
);
```




The global function ` class_meth('cls_name', 'meth_name') ` creates a reference
to a static method on the specified class.




To identify the class you can specify either a constant string containing a
fully qualified class name including namespace, or a class reference using
` MyClassName::class `.




Hack provides a variety of methods that allow you to construct references to
methods for delegation.  The methods in this group are:




+ [` class_meth `](</hack/reference/function/HH.class_meth/>) for static methods on a class
+ [` fun `](</hack/reference/function/HH.fun/>) for global functions
+ [` inst_meth `](</hack/reference/function/HH.inst_meth/>) for instance methods on a single object
+ [` meth_caller `](</hack/reference/function/HH.meth_caller/>) for an instance method where the instance will be determined later
+ Or use anonymous code within a [lambda](</hack/lambdas/introduction>) expression.




# Example




```
<?hh // strict
class C {
    public static function isOdd(int $i): bool { return $i % 2 == 1;}
}
$data = Vector { 1, 2, 3 };

// Each result returns Vector { 1, 3 }
$data->filter(class_meth('C', 'isOdd'));
$data->filter(class_meth(C::class, 'isOdd'));
$data->filter($n ==> { return C::isOdd($n); });
```




## Parameters




* ` string $cls_name ` A constant string with the name of the class, or
  a class reference using `` FullClassName::class ``.
* ` string $meth_name ` A constant string with the name of the static class method.




## Returns




- ` $func_ref ` - A fully typed function reference to the static class method.
<!-- HHAPIDOC -->
