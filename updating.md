# Updating to a new version of HHVM and the HSL

First, switch to the version of HHVM that the documentation site is currently
targeting - you can check `composer.json` to check which this is.

This is needed as the scripts to update the versions are written in Hack.

To use the latest version of HHVM and the HSL:

```
$ bin/update-versions
```

The script will print out next steps; if you are changing the targeted HHVM
version, this will include upgrading your local HHVM.

To use specific tags:

```
$ bin/update-versions --hhvm-tag=HHVM-a.b.c --hsl-tag=vx.y.z
```

See `bin/update-versions --help` for more options.

# Updating to a new version of HHVM and the HSL from a Codespace

First, ensure that your Codespace has a large enough machine type to perform 
these upgrade operations. At minimum, a 16-core, 32GB machine is usually necessary.

After, run `update-versions` to update the targetted HHVM version. 
By default, the script uses the latest, publicly-available HHVM verison.

```
$ bin/update-versions
```

Next, add a commit, push your branch, and create a new Codespace.

**Note:** Creating a new Codespace is necessary because, at this point, the version of HHVM running on the 
Codespace and the targetted version of HHVM (for the upgrade) will be different.

To check the active version on the machine, use this command:

```
$ hhvm --version
```

Next, from the project, update dependencies with:

```
$ php /usr/local/bin/composer update
```

Then, build the site again...

```
$ hhvm bin/build.php
```

... and restart the server...

```
$ hh_client restart
```

... and finish by invoking the test suite and fixing any issues caused by the upgrade.

```
$ hhvm vendor/bin/hacktest tests/
```
