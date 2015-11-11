# The Hack Server

The Hack server works behind the scenes to keep your codebase in constant sync for the [`hh_client` typechecker](../typechecker/introduction.md). However, the server `hh_server` can also be used for some primary standalone functionality as well.

If you want to see all the options available to `hh_server`, see the help via `hh_server --help`.

## Check and Exit

If you want to typecheck a file or a directory of files without the overhead of a constant server running combined with `hh_client`, you can do a quick and dirty check with `hh_server`. 

```
hh_server --check <path> 
```

Like with running `hh_client`, you must ensure that the root of your path has an empty `.hhconfig` file.

Specify a dot `.` to represent checking the current path.

## Automatic Type Annotations

`hh_server` provides a mode where you can take a Hack file or project of Hack files and automatically add type annotations to those files.

**NOTE**: This only works on `<?hh` files.

```
hh_server --convert <path to files to convert> <path to top level of project>
```

Many times the two paths are the same. However, this does give you the flexibility of converting only a subset of a project. Normally, the path to the top level of the project has the `.hhconfig`.

This process annotates with [*soft type hints*](../types/advanced#soft-type-hints) via `@`. This is because the annotation is far from perfect and we would rather have warnings thrown rather than fatal at runtime.

For example, the following unannotated Hack file:

```
<?hh

function foo($x) {
  if ($x + 3 < 10) {
    return false;
  }
  return true;
}

function bar($y) {
  if ($y) {
    return "Hi";
  }
  return null;
}
```

might be converted to:

```
<?hh

function foo($x): @bool {
  if ($x + 3 < 10) {
    return false;
  }
  return true;
}

function bar($y): @?string {
  if ($y) {
    return "Hi";
  }
  return null;
}
```
