Errors reported by the Hack typechecker can be silenced with
`HH_FIXME` and `HH_IGNORE_ERROR` comments.

## Silencing Errors

```
/* HH_FIXME[4110] Your explanation here. */
takes_int("foo");
```

To silence an error, place a comment on the immediately previous
line. The comment must use the `/*` syntax.

This syntax only affects error reporting. It does not change types,
so the typechecker will keep checking the rest of the file as before.

This syntax also **has no runtime effect**. The runtime will do its
best with badly typed code, but it may produce an error immediately,
produce an error later in the program, or coerce values to an unwanted
type.

The behavior of badly typed code may change between HHVM
releases. This will usually be noted in the changelog.

## `HH_FIXME` versus `HH_IGNORE_ERROR`

Both `HH_FIXME` and `HH_IGNORE_ERROR` have the same effect: they
suppress an error.

```
/* HH_FIXME[4110] An example fixme. */
takes_int("foo");

/* HH_IGNORE_ERROR[4110] This is equivalent to the HH_FIXME above. */
takes_int("foo");
```

You should generally use `HH_FIXME`. `HH_IGNORE_ERROR` is intended to
signal to the reader that the type checker is wrong and you are
deliberately suppressing the error. This should be very rare.

## Error Codes

Every Hack error has an associated error code. These are stable across
Hack releases, and new errors always have new error codes.

Hack will ignore error suppression comments that have no effect, to
help migration to newer Hack versions.

Error codes 1000 - 1999 are used for parsing errors. Whilst it is
possible to silence these, the runtime usually cannot run this code at
all.

Error codes 2000 - 3999 are used for naming errors. This includes
references to nonexistent names, as well as well-formedness checks
that don't require type information.

Error codes 4000 - 4999 are used for typing errors.

## Configuring Error Suppression

Once you have removed all the occurrences of a specific error code,
you can ensure that no new errors are added.

You can use the `ignored_fixme_codes` option in `.hhconfig` to forbid
suppression of a specific error code.

```
ignored_fixme_codes = 1002, 4110
```

This forbids `/* HH_FIXME[4110] ... */`.

`.hhconfig` also supports `disallowed_decl_fixmes`, which forbids
error suppression of specific error codes on declarations (types,
class properties etc).

```
disallowed_decl_fixmes = 1002, 4110
```

This forbids `/* HH_FIXME[4110] ... */` outside of function and method
bodies.

Partial mode files have fewer checks. You can opt-in to specific
strict mode checks in partial files by using the error code in
`error_codes_treated_strictly` in `.hhconfig`.

```
error_codes_treated_strictly = 1002, 2045, 2055, 2060, 4005
```

## Best Practices

Great Hack code has no error suppressing comments, and only uses
strict mode.

Suppressing errors in one place can lead to runtime errors in other
places.

```
function takes_int(int $_): void {}

function return_ints_lie(): vec<int> {
  /* HH_FIXME[4110] The type error is here. */
  return vec["foo"];
}

<<__EntryPoint>>
function oh_no(): void {
  $items = return_ints_lie();
  takes_int($items[0]); // But the exception is here!
}
```

Good Hack code has no error suppression comments on its
declarations. Suppressing errors in declarations can hide a large
number of issues elsewhere.

```
function takes_int(int $_): void {}
function takes_float(float $_): void {}

/* HH_FIXME[4030] Missing a return type. */
function returns_something() {
  return "";
}

function oh_no(): void {
  // This is wrong.
  takes_int(returns_something());
  // This is wrong too!
  takes_float(returns_something());
}
```

When you use error suppression, make sure you specify a reason. Try to
keep your comments to small expressions, because the comment applies
to the entire next line.

```
/* HH_FIXME[4110] Bad: this can apply to both function calls! */
$result = foo(bar("stuff"));

/* HH_FIXME[4110] Better: we will spot errors when calling bar. */
$x = foo("stuff");
$result = bar($x);
```
