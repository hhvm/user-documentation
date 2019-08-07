``` yamlmeta
{
    "name": "HH\\meth_caller",
    "sources": [
        "api-sources/hhvm/hphp/system/php/lang/fun.ns.php",
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Create a function reference to an instance method that can be called on any
instance of the same type




``` Hack
namespace HH;

function meth_caller(
  string $cls_name,
  string $meth_name,
);
```




The global function ` meth_caller('cls_name', 'meth_name') ` creates a reference
to an instance method on the specified class.  This method can then be used
to execute across a collection of objects of that class.




To identify the class for the fucntion, use a class reference of the format
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
$v = Vector { Vector { 1, 2, 3 }, Vector { 1, 2 }, Vector { 1 } };

// Each result returns Vector { 3, 2, 1 };
$result2 = $v->map(meth_caller(Vector::class, 'count'));
$result3 = $v->map($x ==> $x->count());
```




## Parameters




* ` string $cls_name ` A constant string with the name of the class, or
  a class reference using `` FullClassName::class ``.
* ` string $meth_name ` A constant string with the name of the instance method.




## Returns




- ` $func_ref ` - A fully typed function reference to the instance method.
<!-- HHAPIDOC -->
