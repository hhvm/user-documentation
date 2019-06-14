The `++` and `--` operands are short-hand notation for 'add 1 or 1.0' and 'subtract 1 or 1.0', respectively, but with a slight twist,
as we shall see. Consider the following, which uses the prefix version of `++`:

```Hack
$i = 10; $i = $i + 1;
$i = 10; ++$i;
```

The two pairs of statements are equivalent; both result in `$i` getting the value 11.  It's simply a matter of style. The same is true
for the postfix version:

```Hack
$i = 10; $i = $i - 1;
$i = 10; $i--;
```

Again, the two pairs of statements are equivalent; both result in `$i` having the value 9.  Note carefully, however, that the ++/--
each contain a side-effect, while the +/- versions do not.  Specifically, the +/- operators do *not* modify either of their operands
while ++/-- do.  However, consider the following:

```Hack
$i = 10; $j = ++$i;
$i = 10; $k = $i++;
```

Yes, `$i` takes on the value of 11 in both cases because the side-effect of incrementing by 1 is the same in each, but the value of `$j`
is the **new** value of `$i`, **after** that variable is incremented (11), while the value of `$k` is the **old** value of `$i`,
**before** that variable is incremented (10);

If the ++/-- operators are at the top-level of a full expression, it's a style issue whether we use pre- or postfix notation.  For example:

```Hack
for ($i = 1; $i <= 10; ++$i) {    // uses prefix ++
  ...
}
for ($i = 1; $i <= 10; $i++) {    // uses postfix ++
  ...
}
```

The expressions `++$i` and `$i++` have the same side-effect. And even though those expressions have different values, those
values are *not* used (after all, that's what it means to be a full expression), so they achieve the same behavior.  However,
the following two loops are *not* equivalent:

```Hack
while (++$i <= 10) {    // uses prefix --
  ...
}
while ($i++ <= 10) {    // uses postfix --
  ...
}
```

While both cause the same side-effect (decrementing `$i` by 1), the values being tested by each `while` are different.
