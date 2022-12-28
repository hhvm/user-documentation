Modules are an experimental feature for organizing code and separating your internal and external APIs. Modules are collections of Hack files that share an identity or utility. 

# Feature Overview 
Here, we give an introduction to the feature. We'll go into specific details and semantics in the next few sections. 

## Module definitions
You can define a new module with the `new module` keywords.
```hack
new module foo {}
```
Modules do not share a namespace with other symbols. Module names can contain periods `.` to help delineate between directories or logical units. Periods in module names do not currently have any semantic meaning, but this may change with new versions of Hack as we expand the functionality fo the feature. 
```hack
new module foo {}
new module foo.bar {}
new module foo.bar.test {}
```

## Module membership 
Any Hack file can be placed in a defined module by writing `module <module name>` at the top of the file. 
```hack
module foo;
class Foo {
  // ...
}
```

## Module level visibility: `internal`
By placing your code in modules, you can use a new visibility keyword: `internal`. An `internal` symbol can only be accessed from within the module. 
```hack
module foo;
public class Foo {}
internal class FooInternal {
  public function foo(): void {}
  internal function bar(): void {}
}
internal function foo_fun(): void {}
```
In general, an internal symbol cannot be accessed outside of the module its defined in. 


```hack
module bar;

public function bar_test(): void {
  $x = new FooInternal(); // error! FooInternal is internal to module foo. 
}
```

