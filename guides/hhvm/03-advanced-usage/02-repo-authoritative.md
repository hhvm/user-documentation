In normal server mode, HHVM continuously checks whether your PHP or Hack files have changed since the last request. This can be a performance hit since most of the time your files *have not* changed, but they still need to be checked anyway.

Repo-authoritative mode allows you to avoid this overhead if you know a priori that your codebase will never change during the lifetime of your HHVM server and the incoming requests. This has *extreme* performance implications since HHVM will *always* know what the layout of your code is and can optimize aggressively with that information.

You build a bytecode file called the *repo* and deploy that file to production instead of the PHP source files. Then the HHVM server process reads from the repo file and never checks for source file changes.

## Building the repo

To build the repo, you pass a certain set of flags to HHVM.

```
hhvm --hphp -t hhbc -v AllVolatile=true --input-dir /path/to/code/to/compile/
```


Flag | Description
-----|------------
`--hphp` | Signals to HHVM that we are doing an offline operation instead of executing PHP or Hack code.
`-t hhbc` | `t` is for target. `hhbc` is for HHVM Bytecode. So the output of the repo will be HHVM bytecode.
`AllVolatile` | Setting this to `true` disables an aggressive optimization that has the possibility to break code. This should be the default value, but we have not gotten around to making that happen yet.
`--input-dir` | The directory containing the source files to compile into the repo.

### Compiling Specific Files


Instead of a directory, you can also pass it an explicit list of filenames to put in the repo or a master file that contains all of the files (one per line) that should be put in the repo.
 
```
hhvm --hphp -t hhbc -v AllVolatile=true file1.php file2.php
hhvm --hphp -t hhbc -v AllVolatile=true --input-list master-file-list.txt
```

The `master-file-list.txt` should look like this:

```
index.php
src/a.php
src/b.php
lib/c.php
```

where you generally specify the root files and all the files in directories under it. Keep the form of the file system on disk in tact.

### Deploying the Repo

After you build the repo, an SQLite3 database file called `hhvm.hhbc` is created. You copy this file to your production server. HHVM will use this file when serving requests and will not need the physical source files. 

You must use the same HHVM binary to run from the repo as you did to build the repo. In other words, a repo is mapped to the binary that built it.

You can put the repo file anywhere as long as these two ini settings are set correctly in your `server.ini` (or equivalent) file.

```
hhvm.repo.authoritative=true
hhvm.repo.central.path=/path/to/hhvm.hhbc
```

### Benefits

The benefits of repo-authoritative mode are:

* No continuous check for source file changes, increasing performance.
* The ability for HHVM to do specialized optimizations knowing that the source files are not changing, again increasing performance.

### Downsides

There is one downside to using repo-authoritative mode:

* Since the repo is static and the *authoritative* snapshot of what will be executed in HHVM, you cannot use functions like [`eval()`](http://php.net/manual/en/function.eval.php) or [`create_function()`](http://php.net/manual/en/function.create-function.php).
