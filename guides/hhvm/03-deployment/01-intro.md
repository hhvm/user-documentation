# Deploying HHVM

After [installing](../installing/intro.md) and deciding on your [configuration options](../configuration/intro.md), you are ready to deploy HHVM.

HHVM has three primary deployment modes, [command-line](#command-line) and [server](#server) (and there is a special case of server mode call [repo-authoritative](#repo-authoritative), as well as a separate [administration server](#admin-server)), and [daemon](#daemon). 

## Command-Line

In command-line (cli) mode, you run the `hhvm` binary from the command-line (passing in any configuration options or files), execute the script and then exit HHVM immediately when the script completes. Here is an example of how to run a script in HHVM cli mode.

```
hhvm -c config.ini myScript.php
```

## Server

Server mode is how you will use HHVM to serve web requests. The HHVM process starts up and continuously waits for requests to come in through either its [FastCGI](./hhvm-servers#fastcgi) server on top of a compatible webserver (e.g., nginx) or [Proxygen](./hhvm-servers#proxygen) webserver (your choice as to which you use; Proxygen is the default).

Multiple requests can, of course, be served simultaneously, and HHVM also caches code to be shared across requests as well.

Here are two examples of how to run HHVM in server mode, one using FastCGI and one using Proxygen. You may or may not have a `server.ini`, depending on whether you have explicit server-specific options you would like to provide. In fact, the `hhvm.server.type`, etc. can be put in `server.ini`, but are shown here as command-line options for illustrative purposes.

```
hhvm -m server -c server.ini -d hhvm.server.type=fastcgi -d hhvm.server.port=9000
hhvm -m server -c server.ini -d hhvm.server.type=proxygen -d hhvm.server.port=8080
```

With FastCGI, you will want to put a FastCGI-compatible webserver in front of it (e.g., nginx). With Proxygen, you don't have to do this, but you can if you want.

## Repo-Authoritative

In normal server mode, HHVM continuously checks whether your PHP or Hack files have changed since the last request. This can be a performance hit since most of the time your files *have not* changed, but they still need to be checked anyway.

Repo-authoritative mode allows you to avoid this overhead if you know a priori that your codebase will never change during the lifetime of your HHVM server and the incoming requests.

You build a bytecode file called the *repo* and deploy that file to production instead of the PHP source files. Then the HHVM server process reads from the repo file and never checks for source file changes.

### Building the repo

To build the repo, you pass a certain set of flags to HHVM. You also pass it an explicit list of filenames to put in the repo or a master file that contains all of the files (one per line) that should be put in the repo.

```
hhvm --hphp -t hhbc -v AllVolatile=true file1.php file2.php
hhvm --hphp -t hhbc --input-list master-file-list.txt
```

Flag | Description
-----|------------
`--hphp` | Signals to HHVM that we are doing an offline operation instead of executing PHP or Hack code
`-t hhbc` | `t` is for target. `hhbc` is for HHVM Bytcode. So the output of the repo will be HHVM bytecode.
`AllVolatile` | This should be disabled by default, but it hasn't yet. And it disables an optimization that requires a bit of care to use correctly.
`--input-list` | The filename containing the list of source files to be put in the repo.

The master file list should like like this:

```
index.php
src/a.php
src/b.php
lib/c.php
```

where you generally specify the root files and all the files in directories under it. Keep the form of the filesystem on disk in tact.

### Deploying the Repo

After you build the repo, a SQLite3 database file called `hhvm.hhbc` is created. You copy this file to your production server. And HHVM will use this file when serving requests and will not need the physical source files. 

You must use the same HHVM binary to run from the repo as you did to build the repo. In other words, a repo is mapped to the binary that built it.

You can put the repo file anywhere as long as these two ini settings are set correctly in your `server.ini` (or equivalent) file.

```
hhvm.repo.authoritative=true
hhvm.repo.central.path=/path/to/hhvm.hhbc
```

### Benefits

The benefits of repo-authoritative mode are:

* No continuous check for source file changes, increasing performance
* The ability for HHVM to do specialized optimizations knowing that the source files are not changing, again increasing performance.

### Downsides

There is one downside to using repo-authoritative mode:

* Since the repo is static and the *authoritative* snapshot of what will be executed in HHVM, you cannot use functions like `eval()` or `create_function()`.

## Daemon

You can run HHVM as a daemon (a background process instead of under the explicit control of a user), you just replace `-m server` with `-m daemon`.

```
hhvm -m daemon -c server.ini -d hhvm.server.type=fastcgi -d hhvm.server.port=9000
hhvm -m daemon -c server.ini -d hhvm.server.type=proxygen -d hhvm.server.port=8080
```

## Admin Server

The admin server allows the administrator of the HHVM server to query and control the HHVM server process. It is different and separate than the primary HHVM server that you specified with `-m server` or `-m daemon`.

To turn on the admin server, you specify the following options at the command line or within your `server.ini` (or equivalent).

```
hhvm.admin_server.port=9001
hhvm.admin_server.password=SomePassword
```

The `port` can be any open port. And you should **always specify a password** to secure the admin port since you don't want just anybody being able to control your server. You will specify the password with every request to the admin port.

### Querying the Admin Server

Once you have set up your admin server, you can query it via `curl`. 

```
curl http://localhost:9001/
```

will bring up a list of commands you can use to control and query your admin server. Use one of these command with your password.

```
curl http://localhost:9001/compiler-id?auth=SomePassword
```
