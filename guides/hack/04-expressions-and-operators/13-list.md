This intrinsic function assigns zero or more elements of its source to the target variables. On success, it returns a copy of the source.  For example:

```Hack
// $min, $max, and $avg must be defined at this point
list($min, $max, $avg) = array(0, 100, 67); // $min is 0, $max is 100, $avg is 67

$v = vec[10, 20, 30];
list($_, $b, $_) = $v; // $b is assigned 20; 1 and 3 are ignored
```

When the source is a vec, the element having an `int` key of 0 is assigned to the first target variable, the element having an `int` key 
of 1 is assigned to the second target variable, and so on, until all target variables have been assigned.

If `$_` is used as a target variable, the value of the corresponding source element is ignored; no assignment takes place.

If the source elements and the target variables overlap in any way, the behavior is unspecified.
