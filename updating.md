# Updating to a new version of HHVM and the HSL

First, switch to the version of HHVM that the documentation site is currently
targetting - you can check `composer.json` to check which this is.

This is needed as the scripts to update the versions are written in Hack.

To use the latest version of HHVM and the HSL:

```
$ bin/update-versions
```

The script will print out next steps; if you are changing the targetted HHVM
version, this will include upgrading your local HHVM.

To use specific tags:

```
$ bin/update-versions --hhvm-tag=HHVM-a.b.c --hsl-tag=vx.y.z
```

See `bin/update-versions --help` for more options.
