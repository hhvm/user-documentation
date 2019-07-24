By default, HHVM starts execution at a single entrypoint file - loading,
compiling, and executing code on-the-fly as it is needed. A `require` of a brand
new file can just load up that file and execute it; writing new files and
then `require`ing them can summon new subclasses into existence. This gives a
lot of flexibility, but prevents some optimizations.

Repo-authoritative mode works differently. A repository (repo) is build ahead of
time, containing all bytecode for the project; this source files are not used
for execution, and do not need to be present at runtime.

The obvious benefit here is that HHVM doesn't re-read your source files on every request, but this is actually the smallest of the optimizations allowed in repo authoritative mode. Because HHVM can see all of your code when originally generating the repo, and no more code can ever be brought into existence after that, HHVM can do a whole lot of inference about what your code is doing, and optimize based on that. For example, it might notice that when a certain member variable is written to, the value written to it will always be an `int`. (It can do this whether your code is PHP or Hack!) HHVM can then know to allocate an int-sized slot in every instance of that object, and to always generate integer instructions to manipulate that slot, without guarding on the type every time during execution. These optimizations can give a huge performance benefit.

To use repo authoritative mode, you need to build a repo, and then deploy that repo (i.e., configure HHVM to use it). You can either do that via an automatic script, or manually.

## Building the Repo

### Everything Under a Root

To build a repo including all files recursively under `/path/to/root`, invoke HHVM like this:

```
hhvm --hphp -t hhbc --input-dir /path/to/root
```

Flag | Description
-----|------------
`--hphp` | Signals to HHVM that we are doing an offline operation instead of executing PHP or Hack code.
`-t hhbc` | `t` is for target. `hhbc` is for HHVM Bytecode. So the output of the repo will be HHVM bytecode.

For a full list of options, see `hhvm --hphp --help`

### Manual List of Files

Instead of a directory, you can also pass it an explicit list of filenames to put in the repo or a master file that contains all of the files, one per line, that should be put in the repo. (Keep in mind that the commands below are generating two *separate* repos -- you can't add to or remove from a repo once it's been generated!)

```
hhvm --hphp -t hhbc file1.php file2.php
hhvm --hphp -t hhbc --input-list master-file-list.txt
```

The `master-file-list.txt` should look like this:

```
index.php
src/a.php
src/b.php
lib/c.php
```

### Specific directories

```
hhvm --hphp -t hhbc --module src --module vendor --ffile public/index.php
```

Flag | Description
-----|------------
`--module` | specifies a directory (module) to include in the repository
`--ffile` | forces a specific file to include in the repository

## Manually Deploying the Repo

After you build the repo, an SQLite3 database file called `hhvm.hhbc` is created. You copy this file to your production server. HHVM will use this file when serving requests and will not need the physical source files.

You must use the same HHVM version to run from the repo as you did to build the repo. In other words, a repo is tied to the version that built it. (Getting this wrong will lead to extremely cryptic errors about missing units in the repo.)

You can put the repo file anywhere as long as these two ini settings are set correctly in your `server.ini` (or equivalent) file.

```
hhvm.repo.authoritative=true
hhvm.repo.central.path=/path/to/hhvm.hhbc
```

## Static Content Cache

A bundle of static files can also be built; this is primarily useful if using
the proxygen server without a separate static resources server.

The most common options are:

- `--file-cache file.cache`: create a file cache in the file `file.cache`
- `--cfile foo.png`: include a specific file
- `--cmodule public/`: include a specific directory

The `hhvm.server.file_cache` option must then be set to the path of the
generated file cache.

The file cache is not supported in CLI mode.

## Entry Points

There are two common complications:
- entry point files must exist
- entry point might not be in the top level of the source repository

### Entry point file must exist

There are two alternative solutions:
- include the file in the static file cache (not usable in CLI mode).
- use the `hhvm.server.allowed_files[]=` option to whitelist it

## Entry point file not in top-level directory

The repository must be built from the top level directory of the project, and
HHVM's source root (defaulting to the current directory) must also be in the
top level directory.

This can complicate setups where the main entrypoint is in a subdirectory, such
as a `public/` subdirectory.

The most common approach is for a single `public/index.hack` file to be the
entrypoint for every HTTP request; this can be configured like:

```
; all request paths are relative to the public/ sub-directory
hhvm.virtual_host[default][path_translation]=public
; if no document requested, use index.php
hhvm.server.default_document=index.php
; if a file does not exist, use index.php
hhvm.server.error_document404=index.php
```

## Tradeoffs

The benefits of repo authoritative mode are discussed above: it dramatically increases the scope of the optimizations HHVM can do to your code.

However, the downside to this is that all your code must be visible to HHVM ahead of time. This means that some kinds of dynamic behavior are not supported, such as:
- `eval()`
- `create_function()`
- `require()`'ing or `include()`'ing files that are not in the repository
- `fb_intercept`, `fb_rename_function` and similar
