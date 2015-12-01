In default operation, HHVM behaves like the original PHP engine: it loads and compiles code on-the-fly as it is needed. A `require` of a brand new file can just load up that file and execute it; `eval` can easily summon new subclasses into existence. This gives a lot of flexibility, but can inhibit a lot of potential optimizations.

Repo authoritative mode works differently. You build a bytecode file ahead of time called the *repo* and deploy that file to production instead of the PHP source files. Then the HHVM server process reads from the repo file and never checks for source file changes.

The obvious benefit here is that HHVM doesn't re-read your source files on every request, but this is actually the smallest of the optimizations allowed in repo authoritative mode. Because HHVM can see all of your code when originally generating the repo, and no more code can ever be brought into existence after that, HHVM can do a whole lot of inference about what your code is doing, and optimize based on that. For example, it might notice that when a certain member variable is written to, the value written to it will always be an `int`. (It can do this whether your code is PHP or Hack!) HHVM can then know to allocate an int-sized slot in every instance of that object, and to always generate integer instructions to manipulate that slot, without guarding on the type every time during execution. These optimizations can give a huge performance benefit.

To use repo authoritative mode, you need to build a repo, and then deploy that repo (i.e., configure HHVM to use it). You can either do that via an automatic script, or manually.

## Automatic Script

If you are using our Debian packages, and have a fairly standard configuration, we provide a shell script to automate building and deploying the repo. If your PHP and Hack source files are under `/path/to/root`, you can run

```
sudo hhvm-repo-mode enable /path/to/root
```

to build the repo and enable repo authoritative mode, and you can run

```
sudo hhvm-repo-mode disable
```

to disable it again.

## Manually Building the Repo

### Everything Under a Root

To build a repo including all files recursively under `/path/to/root`, invoke HHVM like this:

```
hhvm --hphp -t hhbc -v AllVolatile=true --input-dir /path/to/root
```

Flag | Description
-----|------------
`--hphp` | Signals to HHVM that we are doing an offline operation instead of executing PHP or Hack code.
`-t hhbc` | `t` is for target. `hhbc` is for HHVM Bytecode. So the output of the repo will be HHVM bytecode.
`AllVolatile` | Setting this to `true` disables an aggressive optimization that has the possibility to break code. This probably be the default, but unfortunately is not right now.
`--input-dir` | The directory containing the source files to compile into the repo.

### Manual List of Files

Instead of a directory, you can also pass it an explicit list of filenames to put in the repo or a master file that contains all of the files, one per line, that should be put in the repo. (Keep in mind that the commands below are generating two *separate* repos -- you can't add to or remove from a repo once it's been generated!)
 
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

## Manually Deploying the Repo

After you build the repo, an SQLite3 database file called `hhvm.hhbc` is created. You copy this file to your production server. HHVM will use this file when serving requests and will not need the physical source files. 

You must use the same HHVM version to run from the repo as you did to build the repo. In other words, a repo is tied to the version that built it. (Getting this wrong will lead to extremely cryptic errors about missing units in the repo.)

You can put the repo file anywhere as long as these two ini settings are set correctly in your `server.ini` (or equivalent) file.

```
hhvm.repo.authoritative=true
hhvm.repo.central.path=/path/to/hhvm.hhbc
```

## Tradeoffs

The benefits of repo authoritative mode are discussed above: it dramatically increases the scope of the optimizations HHVM can do to your code.

However, the downside to this is that all your code must be visible to HHVM ahead of time. In repo authoritative mode, using a `require` to load new files that are not part of the repo is not allowed. Neither is using functions like [`eval()`](http://php.net/manual/en/function.eval.php) or [`create_function()`](http://php.net/manual/en/function.create-function.php). HHVM cannot dynamically load or run code in repo authoritative mode, since the optimizations rely on seeing all the code during repo build time.
