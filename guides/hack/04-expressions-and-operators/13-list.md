This intrinsic function assigns zero or more elements of its source to the corresponding target variable(s). It returns a copy of the source.  For example:

```Hack
$v = vec[10, 20, 30, 40];
list($_, $b, $_, $d) = $v; 
```

When the source is a vec, the element having an `int` key of 0 is assigned to the first target variable, the element having an `int` key 
of 1 is assigned to the second target variable, and so on, until all target variables have been assigned.

If `$_` is used as a target variable, the value of the corresponding source element is ignored; no assignment takes place.

If the source elements and the target variables overlap in any way, the behavior is unspecified.

Here is an example of a source tuple:

```Hack
list($x1, $x2, $x3) = tuple(123, "red", tuple(2.5, 999));
```

Elements 0, 1, and 2, respectively, of the tuple are assigned to `$x1`, `$x2`, and `$x3`, which have types `int`, `string`, and tuple-of-`float`-and-`int`.

```Hack
list($y1, $y2, list($y3, $y4)) = tuple(123, "red", tuple(2.5, 999));
```

Here, the target contains a nested list, in which case, elements 0 and 1 of the nested tuple are assigned to `$y3` and `$y4`, respectively.
