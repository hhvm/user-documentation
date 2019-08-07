``` yamlmeta
{
    "name": "HH\\inst_meth",
    "sources": [
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Create a function reference to an instance method on an object




``` Hack
namespace HH;

function inst_meth(
  $inst,
  string $meth_name,
);
```




The global function ` inst_meth($inst, 'meth_name') ` creates a reference
to an instance method on the specified object instance.




When using ` inst_meth ` all function calls will go to the single object
instance specified.  To call the same function on a collection
of objects of compatible types, use [` meth_caller `](</hack/reference/function/HH.meth_caller/>).




Hack provides a variety of methods that allow you to construct references to
methods for delegation.  The methods in this group are:




+ [` class_meth `](</hack/reference/function/HH.class_meth/>) for static methods on a class
+ [` fun `](</hack/reference/function/HH.fun/>) for global functions
+ [` inst_meth `](</hack/reference/function/HH.inst_meth/>) for instance methods on a single object
+ [` meth_caller `](</hack/reference/function/HH.meth_caller/>) for an instance method where the instance will be determined later
+ Or use anonymous code within a [lambda](</hack/lambdas/introduction>) expression.




# Example




```
<?hh
class C {
  public function isOdd(int $i): bool { return $i % 2 == 1; }
}

$C = new C();
$data = Vector { 1, 2, 3 };

// Each result returns Vector { 1, 3 }
var_dump($data->filter(inst_meth($C, 'isOdd')));
var_dump($data->filter($n ==> { return $C->isOdd($n); }));
```




## Parameters




* ` $inst ` The object whose method will be referenced.
* ` string $meth_name ` A constant string with the name of the instance method.




## Returns




- ` $func_ref ` - A fully typed function reference to the instance method.
<!-- HHAPIDOC -->
