``` yamlmeta
{
    "name": "HH\\fun",
    "sources": [
        "api-sources/hhvm/hphp/hack/hhi/func_pointers.hhi"
    ]
}
```




Create a function reference to a global function




``` Hack
namespace HH;

function fun(
  string $func_name,
);
```




The global function ` fun('func_name') ` creates a reference to a global
function.




The parameter ` 'func_name' ` is a constant string with the full name of the
global function to reference.




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
$v = vec["Hello", " ", "World", "!"];

// Each line below prints "Hello World!"
Vec\map($v, fun('printf'));
Vec\map($v, $x ==> { printf($x); });
```




## Parameters




* ` string $func_name ` A constant string with the name of the global method, including namespace if required.




## Returns




- ` $func ` - A fully typed function reference to the global method.
<!-- HHAPIDOC -->
