After [installing HHVM](../installation/introduction.md), you will want to configure it to run scripts from the command line and/or serve web traffic.

## Configuration Options

HHVM has a very large set of [configuration options](./ini-settings.md). Many are not meant for the end HHVM user, but there are some key options that will be useful for anyone deploying HHVM.

### INI Format

HHVM uses configuration files in [INI format](https://en.wikipedia.org/wiki/INI_file). In an INI file, each line represents a configuration in key/value format, where the key is the name of the option, while the value is the value for that option. For example,

```
hhvm.force_hh = 1
hhvm.server_variables[MY_VARIABLE] = "Hello"
```

These settings can be specified in one of two places, or in a combination of both:

* A configuration file, normally suffixed with `.ini` (e.g., `config.ini`)
* At the command line using the `-d` flag to the HHVM binary.

```
hhvm -c config.ini file.php
hhvm -d hhvm.force_hh = 1 file.php
hhvm -c config.ini -d hhvm.log.file = /tmp/temp.log -d hhvm.force_hh = 1 file.php
```

If the same option is specified more than once, then the option that HHVM reads last will be the value used. HHVM reads the command line left to right and INI configuration files top to bottom.

### Key Options

Option | Type | Default | Description
-------|------|---------|------------
`hhvm.server_variables` | array | `$_SERVER` | Sets the contents of the `$_SERVER` variable. 
`hhvm.enable_obj_destruct_call` | boolean | `false` | If `false`, `__destruct()` methods will not be called on an object at the end of the request. This can be a performance benefit if your system and application can handle the memory requirements. Deallocation can occur all at one time. If `true`, then HHVM will run all `__destruct()` methods in the usual way. 
`hhvm.hack.lang.look_for_typechecker` | boolean | `true` | When `true`, HHVM will only process Hack `<?hh` files if the Hack typechecker server is available and running. You normally turn this off in production and it will be turned off automatically in [repo authoritative mode](../deployment/modes.md).
`hhvm.jit_enable_rename_function` | boolean | `false` | If `false`, `rename_function()` will throw a fatal error. And HHVM knowing that functions cannot be renamed can increase performance.
`hhvm.server.thread_count` | integer | 2x the number of CPU cores | This specifies the number of worker threads used to serve web traffic in [server mode](./deployment/modes.md). The number to set here is really quite experimental. If you use [`async`](../../guides/hack/async/introduction.md), then this number can be the default. Otherwise, you might want a higher number.
`hhvm.source_root` | string | working directory of HHVM process | For [server mode](./deployment/modes.md), this will hold the path to the root of the directory of the code being served up. This setting is *useless* in repo-authoritative mode.
`hhvm.force_hh` | boolean | `false` | If `true`, treat all code as Hack code, even if it starts with `<?php`.
`hhvm.log.file` | string | standard error | The location of the HHVM error log file. 
`hhvm.repo.authoritative` | boolean | `false` | If `true`, you are specifying that you will be using HHVM's repo-authoritative mode to serve requests.
`hhvm.repo.central.path` | string | `""` | The path to the `hhvm.hhbc` file created when you compiled a repo-authoritative repo.
`hhvm.server.type` | string | `"Proxygen"` | The type of server you are planning to use to help server up requests for the HHVM server. The default is `"Proxygen"`, but you can also specify `"fastcgi"`
`hhvm.server.port` | integer | 80 | The port on which the HHVM server will listen for requests.
`hhvm.server.default_document` | string | `"index.php"` | The default document that will be served if a page is not explicitly specified.
`hhvm.server.error_document404` | string | `"index.php"` | The default 404 error document that will be served when a 404 error occurs.
