Here is the raw list of all possible ini settings that can go in your `/etc/hhvm/php.ini`, `/etc/hhvm/server.ini` or any custom `.ini` file. Not all of them are useful to the HHVM end user. There is lots of cleanup work to do here, but for now you get sorted lists. 

Any setting prefixed with `hhvm.` are HHVM-specific options.

## Supported PHP INI Settings

Here is the supported list of [PHP INI settings](http://php.net/manual/en/ini.list.php) for HHVM. The documentation for each is available when you click the option.

@@ guides-generated-markdown/php_ini_support_in_hhvm.md @@

## Common Options

These are the options that are probably the most commonly used on a day-to-day basis by users of HHVM.

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.server_variables` | `array` | `$_SERVER` | Sets the contents of the `$_SERVER` variable. 
| `hhvm.enable_obj_destruct_call` | `bool` | `false` | If `false`, `__destruct()` methods will not be called on an object at the end of the request. This can be a performance benefit if your system and application can handle the memory requirements. Deallocation can occur all at one time. If `true`, then HHVM will run all `__destruct()` methods in the usual way. 
| `hhvm.hack.lang.look_for_typechecker` | `bool` | `true` | When `true`, HHVM will only process Hack `<?hh` files if the Hack typechecker server is available and running. You normally turn this off in production and it will be turned off automatically in [repo authoritative mode](../advanced-usage/repo-authoritative.md).
| `hhvm.jit_enable_rename_function` | `bool` | `false` | If `false`, `rename_function()` will throw a fatal error. And HHVM knowing that functions cannot be renamed can increase performance.
| `hhvm.server.thread_count` | `int` | 2x the number of CPU cores | This specifies the number of worker threads used to serve web traffic in [server mode](../basic-usage/server.md). The number to set here is really quite experimental. If you use [`async`](/hack/async/introduction), then this number can be the default. Otherwise, you might want a higher number.
| `hhvm.server.source_root` | `string` | working directory of HHVM process | For [server mode](../basic-usage/server.md), this will hold the path to the root of the directory of the code being served up. This setting is *useless* in [repo-authoritative mode](/hhvm/advanced-usage/repo-authoritative).
| `hhvm.force_hh` | `bool` | `false` | If `true`, all code is treated as Hack code, even if it starts with `<?php`.  This setting affects `hhvm.enable_xhp` by forcing it to be `true` as well. This setting affects `hhvm.hack.lang.ints_overflows_to_ints` and `hhvm.log.always_log_unhandled_exceptions` by being the default value for them when they is not explicitly set. This setting affects `hhvm.server.allow_duplicate_cookies` by being the opposite value for a default when it is not explicitly set.
| `hhvm.log.file` | `string` | standard error | The location of the HHVM error log file. 
| `hhvm.repo.authoritative` | `boolean` | `false` | If `true`, you are specifying that you will be using HHVM's repo-authoritative mode to serve requests.
| `hhvm.repo.central.path` | `string` | `""` | The path to the `hhvm.hhbc` file created when you compiled a repo-authoritative repo.
| `hhvm.server.type` | `string` | `"Proxygen"` | The type of server you are planning to use to help server up requests for the HHVM server. The default is `"Proxygen"`, but you can also specify `"fastcgi"`.
| `hhvm.server.port` | `int` | `80` | The port on which the HHVM server will listen for requests.
| `hhvm.server.default_document` | `string` | `"index.php"` | The default document that will be served if a page is not explicitly specified.
| `hhvm.server.error_document404` | `string` | `"index.php"` | The default 404 error document that will be served when a 404 error occurs.

## PHP 7 Settings

For changes from PHP 5 to PHP 7 which are backwards incompatible, INI options are available to choose which behavior HHVM respects. (Features which are not backwards incompatible are always available.)

The vast majority of users will want to just set `hhvm.php7.all = 1` to fully enable PHP 7 mode and can ignore the rest of the options in this section. They are available primarily for advanced users who want to do a more gradual migration or otherwise track down compatibility issues.

| Setting | Type | Default | Description | PHP 7 RFC 
|---------|------|---------|-------------|----------
| `hhvm.php7.all` | `bool` | `false` | Default value for all of the below | N/A
| `hhvm.php7.deprecate_old_style_ctors` | `bool` | `hhvm.php7.all` | Disallow and warn when using old PHP 4 constructors | [Remove PHP 4 constructors](https://wiki.php.net/rfc/remove_php4_constructors)
| `hhvm.php7.engine_exceptions` | `bool` | `hhvm.php7.all` | Enable throwing the new `Error` heirarchy of exceptions | [Engine exceptions](https://wiki.php.net/rfc/engine_exceptions_for_php7)
| `hhvm.php7.int_semantics` | `bool` | `hhvm.php7.all` | Change some edge-case int and float behavior, such as divide/mod by zero | [Integer semantics](https://wiki.php.net/rfc/integer_semantics) with some changes due to [engine exceptions](https://wiki.php.net/rfc/engine_exceptions_for_php7)
| `hhvm.php7.ltr_assign` | `bool` | `hhvm.php7.all` | Make order of assignment in `list()` lvalues consistent | [Abstract syntax tree](https://wiki.php.net/rfc/abstract_syntax_tree)
| `hhvm.php7.no_hex_numerics` | `bool` |`hhvm.php7.all` | Don't consider hex strings to be numeric | [Remove hex support in numeric strings](https://wiki.php.net/rfc/remove_hex_support_in_numeric_strings)
| `hhvm.php7.scalar_types` | `bool` | `hhvm.php7.all` | Enable PHP 7-style scalar type annotations (NB: not the same as Hack's) | [Scalar type declarations](https://wiki.php.net/rfc/scalar_type_hints_v5)
| `hhvm.php7.uvs` | `bool` | `hhvm.php7.all` |  Fix some odd precedence and order of evaluation issues | [Uniform variable syntax](https://wiki.php.net/rfc/uniform_variable_syntax)

## Server Mode

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.server.default_document` | `string` | `"index.php"` | The default document that will be served if a page is not explicitly specified.
| `hhvm.server.error_document404` | `string` | `''` | The default 404 error document that will be served when a 404 error occurs. 
| `hhvm.server_variables` | `Map` | *empty* | Set the contents of the `$_SERVER` variable. You set them in the form of `hhvm.server_variables[X]=Y`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.env_variables` | `Map` | *empty* | Set the contents of the `$_ENV` variable. You set them in the form of `hhvm.env_variables[X]=Y`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.static_file.extensions` | `Map` | (see description) | Map of filename extensions to content types for use by the proxygen server. The defaults are [https://gist.github.com/JoelMarcey/6ce7acda06a475afcb32](https://gist.github.com/JoelMarcey/6ce7acda06a475afcb32). You set them in the form of `hhvm.static_file.extensions[]=Y`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.php_file.extensions` | `Map` | *empty* | Normally, `.php` and `.hh` are treated as source code. With this setting you can add other file extensions to be treated as source code. You set them in the form of `hhvm.php_file.extensions["pp"]=".pp"`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.server.forbidden_file_extensions` | `Set` | *empty* | Map of filename extensions that will not be loaded by the server. You set them in the form of `hhvm.server.forbidden_file_extensions[]=".exe"`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.server.allow_duplicate_cookies` | `bool` | `!hhvm.force_hh` | If enabled, this allows duplicate cookies for a name-domain-path triplet.
| `hhvm.server.allowed_exec_cmds` | `Vector` | *empty* | A whitelist of acceptable process commands for something like `pcntl_exec`. This setting is only effective if `hhvm.server.whitelist_exec` is `true`. You set them in the form of `hhvm.server.allowed_exec_cmds[]="cmd"`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.server.always_populate_raw_post_data` | `bool` | `false` | Generally, if the content type is multipart/form-data, `$HTTP_RAW_POST_DATA` should not always be available. If this is enabled, then that data will always be available.
| `hhvm.server.always_use_relative_path` | `bool` | `false` | If enabled, files will be looked up and invoked via a relative path. In [sandbox](#sandbox) mode, files always use a relative path.
| `hhvm.server.backlog` | `int` | 128 | The maximum queue length for incoming connections.
| `hhvm.server.connection_limit` | `int` | `0` | The maximum number of connections the server (e.g., [Proxygen](/hhvm/basic-usage/proxygen)) can accept. The default is `0`, which is unlimited.
| `hhvm.server.connection_timeout_seconds` | `int` | `-1` | The maximum number of seconds a connection is allowed to stand idle after its previous read or write. If `-1`, this defaults to the server default (e.g., for Proxygen](/hhvm/basic-usage/proxygen) this is 50 seconds).
| `hhvm.server.dangling_wait` | `int` | `0` | The number of seconds to wait for a dangling server to respond. A [dangling server](https://github.com/facebook/hhvm/blob/master/hphp/doc/server.dangling_server) allows the possibility for an older version of a server to run on a different port in case a page needs to be served from that old version.
| `hhvm.server.default_charset_name` | `string` | `''` | This is used for PHP responses in case no other charset has been set explicitly. `"UTF-8"` is an example of a possible setting.
| `hhvm.server.default_server_name_suffix` | `string` | `''` | If a server name is not specified for a virtual host, then the virtual prefix is prepended to this setting to create a server name. 
| `hhvm.server.enable_early_flush` | `bool` | `true` | Allows chunked encoding responses.
| `hhvm.server.enable_keep_alive` | `bool` | `true` | If enabled, the server will remain open for connection until `hhvm.server.connection_timeout_seconds` timeout.
| `hhvm.server.enable_on_demand_uncompress` | `bool` | `true` | If enabled, this allows on-demand uncompress when reading from the file cache to avoid storing the uncompressed contents for compressible files.
| `hhvm.server.enable_output_buffering` | `bool` | `false` | Turn output buffering on. While output buffering is active no output is sent from the script (other than headers), instead the output is stored in an internal buffer.
| `hhvm.server.enable_ssl` | `bool` | `false` | If enabled, HHVM will allow SSL connections to come through. Related to `hhvm.server.ssl_port`, `hhvm.server.ssl_certificate_file`, `hhvm.server.ssl.certificate_key_file`, `hhvm.server.ssl_certificate_dir`.
| `hhvm.server.enable_static_content_from_disk` | `bool` | `true` | A static content cache creates one single file from all static contents, including css, js, html, images and any other non-PHP files. Normally this is prepared by the compiler at compilation time, but it can also be prepared at run-time, if `hhvm.server.source_root` points to real file directory and this setting is `true`. Otherwise, use `hhvm.server.file_cache` to point to the static content cache file created by the compiler. 
| `hhvm.server.error_document500` | `string` | `''` | The default 500 error document that will be served when a 500 error occurs. 
| `hhvm.server.evil_shutdown` | `bool` | `true` | Kill anything listening on the server port. This is enabled by default. When stopping a server, HHVM first tries to gracefully shut it down. If that doesn't work, and `hhvm.server.harsh_shutdown` is enabled, it will try to kill the `pid` file. If that doesn't work, then `hhvm.server.evil_shutdown` is invoked. 
| `hhvm.server.exit_on_bind_fail` | `bool` | `false` | If the HHVM server cannot start because there is an older HHVM server running, if this flag is enabled, then the current HHVM just quits trying to start the server. If this is not enabled, HHVM try harsher measures to stop the older server so the current one can start up again.
| `hhvm.server.expires_active` | `bool` | `true` | If enabled, then cached static content will expire after the duration of `hhvm.server.expires_default`.
| `hhvm.server.expires_default` | `int` | 2592000 | If `hhvm.server.expires_active` is enabled, then cached static content will expire after this amount of time. The default is `2592000` seconds (or 30 days).
| `hhvm.server.expose_hphp` | `bool` | `true` | Expose the `X-Powered-By HHVM` version header. 
| `hhvm.server.expose_xfb_debug` | `bool` | `false` | If enabled, Facebook specific debugging information is exposed.
| `hhvm.server.expose_xfb_server` | `bool` | `false` | Facebook specific debugging information is exposed.
| `hhvm.server.fatal_error_message` | `string` | `''` | If this string is not empty, then when you encounter a 500, the message associated with the string is shown.
| `hhvm.server.file_cache` | `string` | `''` | An absolute path to where the static content (e.g., css, html, etc.) created during compilation should be loaded. `hhvm.server.enable_static_content_from_disk` needs to be enabled for this setting to take effect.
| `hhvm.server.file_socket` | `string` | `''` | If this string is not empty, then a file socket is used instead of an IP address for the server.
| `hhvm.server.fix_path_info` | `bool` | `false` | If enabled, this changes [fastcgi](/hhvm/advanced-usage/fastCGI) path from `SCRIPT_FILENAME` to `PATH_TRANSLATED`.
| `hhvm.server.forbidden_as404` | `bool` | `false` | If the extension of a URI is in the ``hhvm.server.forbidden_file_extensions` map, and this option is enabled, then that extension cannot be used as a 404 option either.
| `hhvm.server.force_chunked_encoding` | `bool` | `false` | If enabled, the server will only send chunked encoding responses for uncompressed payloads.
| `hhvm.server.force_compression.cookie` | `string` | `''` | For compression, if this string is set and the cookie is present in the request, then compression should happen.
| `hhvm.server.force_compression.param` | `string` | `''` | For compression, if this string is set and the parameter is present in the request, then compression should happen.
| `hhvm.server.force_compression.url` | `string` | `''` | For compression, if this URL is set and the request matches exactly, then compression has to happen.
| `hhvm.server.force_server_name_to_header` | `bool` | `false` | If enabled, then `$_SERVER['SERVER_NAME']` must come from the request header.
| `hhvm.server.graceful_shutdown_wait` | `int` | `0` | The amount of time to wait for a graceful shutdown of a server. If it doesn't shutdown during that period of time, then `hhvm.server.harsh_shutdown` may be invoked.
| `hhvm.server.gzip_compression_level` | `int` | `3` | When compression with gzip, this is the level of compression that will be used. `1` is fastest. `9` is best.  
| `hhvm.server.harsh_shutdown` | `bool` | `true` | When stopping a server, HHVM first tries to gracefully shutdown any previous incarnation of the server. If that doesn't work, and `hhvm.server.harsh_shutdown` is enabled, it will try to kill the `pid` file associated with the server process.
| `hhvm.server.host` | `string` | `''` | The default host for the server. 
| `hhvm.server.http_safe_mode` | `bool` | `false` | If enabled, then you cannot open an HTTP stream.
| `hhvm.server.image_memory_max_bytes` | `int` | `0` | The maximum memory size for image process. If `0`, then it will be set to `hhvm.server.upload.upload_max_file_size` * 2.
| `hhvm.server.implicit_flush` | `bool` | `false` | If set to true, then the output buffer will be set to implicitly flush when executing requests.
| `hhvm.server.ip` | `string` | `''`| The default ip address for the server.
| `hhvm.server.kill_on_sigterm` | `bool` | `false` | If enabled, and the server receives a SIGTERM signal, then server will be stopped.
| `hhvm.server.light_process_count` | `int` | `0` | The number of light processes to turn on. Light processes have very little forking cost because they are pre-forked. They can provide for faster shell command execution.
| `hhvm.server.light_process_file_prefix` | `string` | `./lightprocess` | The file prefix for a light process.
| `hhvm.server.lock_code_memory` | `bool` | `false` | Unless this is enabled, during paging the server into memory, the binary is `munlock()`ed.
| `hhvm.server.max_array_chain`| `int` | `INT_MAX` | For balancing arrays. Normally this is best left as the default.
| `hhvm.server.max_post_size` | `int` | `100` | The maximum POST content-length. This is 100 MB.
| `hhvm.server.memory_head_room` | `int` | `0` | How much memory headroom is allowed. If kept at the default, then the active memory limit is `std::numeric_limits<size_t>::max()`.
| `hhvm.server.output_handler` | `string` | `''` | A custom output buffer handler. If left empty, then the default is used.
| `hhvm.server.path_debug`| `bool` | `false` | If a 404 is returned, and this is enabled, then the URL paths examined will be displayed.
| `hhvm.server.port` | `int` | `80` | The port on which the HHVM server will listen for requests.
| `hhvm.server.prod_server_port` | | |
| `hhvm.server.psp_timeout_seconds` | | |
| `hhvm.server.request_body_read_limit` | | |
| `hhvm.server.request_init_document` | | |
| `hhvm.server.request_init_function` | | |
| `hhvm.server.request_memory_max_bytes` | | |
| `hhvm.server.request_timeout_seconds` | | |
| `hhvm.server.response_queue_count` | | |
| `hhvm.server.safe_file_access` | | |
| `hhvm.server.shutdown_listen_no_work` | | |
| `hhvm.server.shutdown_listen_wait` | | |
| `hhvm.server.ssl_certificate_dir` | | |
| `hhvm.server.ssl_certificate_file` | | |
| `hhvm.server.ssl_certificate_key_file` | | |
| `hhvm.server.ssl_port` | | |
| `hhvm.server.startup_document` | | |
| `hhvm.server.stat_cache` | | *false* | Cache calls to stat.
| `hhvm.server.takeover_filename` | | | for port takeover between server instances.
| `hhvm.server.thread_count` | `int` | 2x the number of CPU cores | This specifies the number of worker threads used to serve web traffic in [server mode](../basic-usage/server.md). The number to set here is really quite experimental. If you use [`async`](/hack/async/introduction), then this number can be the default. Otherwise, you might want a higher number.
| `hhvm.server.thread_drop_cache_timeout_seconds` | | |
| `hhvm.server.thread_drop_stack` | | |
| `hhvm.server.thread_job_lifo_switch_threshold` | | |
| `hhvm.server.thread_job_max_queuing_milli_seconds` | | |
| `hhvm.server.thread_round_robin` | | _False_ | Last thread serves next.
| `hhvm.server.tls_client_cipher_spec` | | |
| `hhvm.server.tls_disable_tls1_2` | | |
| `hhvm.server.type` | `string` | `"Proxygen"` | The type of server you are planning to use to help server up requests for the HHVM server. The default is `"Proxygen"`, but you can also specify `"fastcgi"`.
| `hhvm.server.unserialization_whitelist_check` | | |
| `hhvm.server.unserialization_whitelist_check_warning_only` | | |
| `hhvm.server.upload.enable_file_uploads` | | |
| `hhvm.server.upload.enable_upload_progress` | | |
| `hhvm.server.upload.rfc1867freq` | | |
| `hhvm.server.upload.rfc1867name` | | |
| `hhvm.server.upload.rfc1867prefix` | | |
| `hhvm.server.upload.upload_max_file_size` | | |
| `hhvm.server.upload.upload_tmp_dir` | | |
| `hhvm.server.use_direct_copy` | | |
| `hhvm.server.user` | | |
| `hhvm.server.utf8ize_replace` | | |
| `hhvm.server.warmup_document` | | | path to document that lists requests to warm up with.
| `hhvm.server.warmup_throttle_request_count` | | |
| `hhvm.server.warn_on_collection_to_array` | | |
| `hhvm.server.whitelist_exec` | | |
| `hhvm.server.whitelist_exec_warning_only` | | |
| `hhvm.server.xfb_debug_ssl_key` | | |
| `hhvm.http.default_timeout` | | 30 | HTTP default timeout, in seconds.
| `hhvm.http.slow_query_threshold` | | 1000 |
| `hhvm.pid_file` | | |
| `hhvm.static_file.generators` | `Set` | *empty* | Dynamic files that serve up static content. This is not normally set. You set them in the form of `hhvm.static_file.generators[]="/path/to"`. If you are setting just one, command line `-d` is fine. Otherwise, for multiple settings, use a `.ini` file.
| `hhvm.static_file.files_match` | `Vector` | *empty* | A list of file extensions that will have http transport headers added to them. **This setting is currently not retrievable via `ini_get()`**. This is not normally set. You set them in and `.ini` file with the form of `hhvm.static_file.files_match[pattern]="[regex](here)*"`, `hhvm.static_file.files_match[headers][]="header1"`, `hhvm.static_file.files_match[headers][]="header2"`. You need a `pattern` and at least one `header`.

## Feature flags

These settings enable various features in the runtime, including [Hack](/hack/)-specific features.

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.enable_obj_destruct_call` | `bool` | `false` | If `false`, `__destruct()` methods will not be called on an object at the end of the request. This can be a performance benefit if your system and application can handle the memory requirements. Deallocation can occur all at one time. If `true`, then HHVM will run all `__destruct()` methods in the usual way. 
| `hhvm.force_hh` | `bool` | `false` | If `true`, all code is treated as Hack code, even if it starts with `<?php`.  This setting affects `hhvm.enable_xhp` by forcing it to be `true` as well. This setting affects `hhvm.hack.lang.ints_overflows_to_ints` and `hhvm.log.always_log_unhandled_exceptions` by being the default value for them when they are not explicitly set. This setting affects `hhvm.hack.lang.look_for_typechecker` and `hhvm.server.allow_duplicate_cookies` by being the opposite value for a default when they are not explicitly set.
| `hhvm.hack.lang.ints_overflow_to_ints` | `bool` | Value of `hhvm.force_hh` | Value of `hhvm.force_hh` | Don't check if integer arithmetic might overflow, just use asm intrinsics and do whatever the underlying processor would do, most likely a twos-complement wraparound. If disabled, then check for integer overflow, and promote up to a float if so. (Skipping the check is considerably faster.)
| `hhvm.hack.lang.look_for_typechecker` | `bool` | Opposite value of `hhvm.force_hh` | If enabled, make sure that Hack code is under a directory with a `.hhconfig` file, and error otherwise.
| `hhvm.enable_args_in_backtraces` | `bool` | `true` | If disabled, then arguments are not shown in PHP backtraces.
| `hhvm.enable_asp_tags` | `bool` | `false` | If enabled, then you can use `<% %>`.
| `hhvm.enable_hip_hop_experimental_syntax` | `bool` | `false` | Enables experimental syntax, including type hints for local variables and global variables.
| `hhvm.enable_numa` | `bool` | `false` | Enable [NUMA](https://en.wikipedia.org/wiki/Non-uniform_memory_access) integration.
| `hhvm.enable_numa_local` | `bool` | `false` | This causes all allocations from threads to be allocated on the local node (except for a few that have been explicitly marked interleaved). `hhvm.enable_numa` must be set to `true` for this to take affect.
| `hhvm.enable_short_tags` | `bool` | `false` | If enabled, this allows the `<?` tag.
| `hhvm.enable_xhp` | `bool` | `false` | If `true`, this will enable XHP support in PHP files. (XHP is always enabled in Hack files.) If `hhvm.force_hh` is set to `true`, then this setting is automatically `true`.
| `hhvm.enable_zend_compat` | `bool` | `false` | If `true`, this enable the support layer for Zend PHP extensions that we have directly [migrated to HHVM](https://github.com/facebook/hhvm/tree/master/hphp/runtime/ext_zend_compat) (e.g. FTP).
| `hhvm.enable_zend_sorting` | `bool` | `false` | If `true`, support is enabled for Zend PHP sort stability. There are [cases](/hhvm/inconsistencies/arrays-and-foreach#sorting) where sorting output is indeterministic between HHVM and PHP.
| `hhvm.authoritative_mode` | `bool` | `false` | If enabled, HHVM disallows constructs that are unavailable in [Repo Authoritative](/hhvm/advanced-usage/repo-authoritative) mode even when you are not in Repo Authoritative mode (i.e., when `hhvm.repo.authoritative` is `false`).

## Logging

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.log.access_log_default_format | default access log format if not specified, uses Apache access log formatting | `%h %l %u %t \"%r\" %>s %b` |
| hhvm.log.admin_log.file | | |
| hhvm.log.admin_log.format | | |
| hhvm.log.admin_log.sym_link | | |
| hhvm.log.always_escape_log | whether to escape characters in error log | _True_ |
| hhvm.log.always_log_unhandled_exceptions | Unhandled exceptions are PHP fatal errors, and AlwaysLogUnhandledExceptions will make sure they get logged even if a user’s error handler is installed for them. | true |
| hhvm.log.drop_cache_chunk_size | | |
| hhvm.log.file | The location of the HHVM error log file | stderr |
| hhvm.log.header | Header includes timestamp, process id, 34 thread id, request id (counted from 1 since server starts), message id (counted from 1 since request started) and extra header text from command line option (see util/logger.cpp for implementation). | _False_ |
| hhvm.log.header_mangle | This setting controls logging of potentially malicious headers.  If HeaderMangle is greater than 0, then HipHop will log one in every n requests where a header collision has occurred.  Such collisions almost certainly indicate a malicious attempt to set headers which are either set or filtered by a proxy. | _False_ |
| hhvm.log.level | | |
| hhvm.log.max_messages_per_request | Controls maximum number of messages each request can log | -1 |
| hhvm.log.native_stack_trace | | |
| hhvm.log.no_silencer | even when silencer (`@`) operator is used, still output errors | _False_ |
| hhvm.log.runtime_error_reporting_level | (numeric) corresponds to "error_reporting" in PHP | 8191 = E_ALL |
| hhvm.log.sym_link | if using cronolog, create a symlink to the current log specified by `hhvm.log.file` | _False_ |
| hhvm.log.use_cronolog | whether to switch logging to a new file every X time, useful for rotating logs | _False_ |
| hhvm.log.use_log_file | | |
| hhvm.log.use_request_log | | |
| hhvm.log.use_syslog | log to syslog | _False_ |
| hhvm.log.access | | |

## Admin Server

The [admin server](/hhvm/advanced-usage/admin-server) allows the administrator of the HHVM server to query and control the HHVM server process. 

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.admin_server.password` | `string` | `''` | A password required for all requests to the admin server, other than the index. Is passed to the request as the `auth` request var.
| `hhvm.admin_server.port` | `int` | `0` | The port the admin server should listen on. If set to 0, the admin server is not started.
| `hhvm.admin_server.thread_count` | `int` | `1` | The number of threads the admin server should use.

## Debug Settings

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.debug.clear_input_on_success | automatically delete requests that had a 200 response code when recording input | _True_ |
| hhvm.debug.core_dump_email | email address to email core dump to | |
| hhvm.debug.core_dump_report | whether or not to generate a core dump report | _True_ |
| hhvm.debug.core_dump_report_directory | where to put the core dump report | `/tmp` |
| hhvm.debug.full_backtrace | | |
| hhvm.debug.local_memcache | | |
| hhvm.debug.memcache_read_only | | |
| hhvm.debug.native_stack_trace | | |
| hhvm.debug.profiler_output_dir | Building with GOOGLE_CPU_PROFILER set lets you collect profiles from the server or from the command line, this option lets you control where profiles get created | |
| hhvm.debug.record_input | whether to record bad HTTP requests to a file `/tmp/hphp_request_XXXXXX"` | _False_ |
| hhvm.debug.server_error_message | send the error message to the output stream - corresponds to "display_errors" in PHP | |
| hhvm.debug.simple_counter.sample_stack_count | | |
| hhvm.debug.simple_counter.sample_stack_depth | | |
| hhvm.debug.translate_leak_stack_trace | | |
| hhvm.debug.translate_source | translate C++ file and line numbers into original PHP file and line numbers | _False_ |
| hhvm.dump_ast | | |
| hhvm.dump_bytecode | Before executing a PHP file, dump out its HHBC along with some interesting metadata, then continue executing the file. Useful only for debugging. | _False_ |
| hhvm.dump_hhas | Instead of executing a PHP file, dump out an hhas file and exit. Useful for debugging, or if you need to directly write some hhas and need an easy way to get started. | _False_ |
| hhvm.dump_ring_buffer_on_crash | | |
| hhvm.dump_tc | dump contents of translation cache when executing program from the command line | _False_ |
| hhvm.dump_tc_anchors | | |
| hhvm.keep_perf_pid_map | don't delete the perf pid map | _False_ |
| hhvm.perf_data_map | | |
| hhvm.perf_pid_map | whether to generate a perf pid map | _True_ |

## Sandbox

A sandbox in HHVM is a set of configuration options (document root, log file path, etc.) that can be used to serve your web application. 

Here are a few **important** points:

- The sandbox configuration file must end in `.hdf` or `.hphp`. Most people name it `.hphp`. 
- Having a configuration file end in `.ini` is currently broken, but a fix is being worked on now. When HDF is removed in favor of INI, this wil be fixed.
- A user is always appended to `hhvm.sandbox.home`. So if you set that setting to `/home`, it will end up being `/home/user`. Thus the `hhvm.sandbox.conf_file` will end up having an absolute path of `/home/user/.hphp`.
- The sandbox pattern assumes that you have valid URLs that can be associated with that pattern. You would need to have those URLs bound in something like `/etc/hosts` (e.g., `127.0.0.1 user-another_site.localhost.com`).
- If you do not specify a sandbox name in the URL, it assumes the default sandbox. e.g., if you type or `curl` `user.localhost.com`, that will assume your default sandbox.
- If you enable `hhvm.sandbox.from_common_root`, make sure you have running code available from that root, or that root prepended by the value of `hhvm.sandbox.directories_root`, if you have that set as well.
- If you are using the HHVM builtin webserver [proxygen](/hhvm/basic-usage/proxygen), as long as you are running the server from a location where there is access to your sandbox (e.g., the root of a sandbox directory), all of your sandboxes URLs should be available to you for testing.

Below is a general configuration setup for a sandbox that you can use as a template. 

*ini file*

`user-another_site.localhost.com` would fit the `hhvm.sandbox.pattern` pattern.

```
hhvm.sandbox.sandbox_mode = 1
hhvm.sandbox.home=/home
hhvm.sandbox.conf_file=.hphp
hhvm.sandbox.pattern=([^-]*(-[^-]*)?).localhost.com
```

*Sandbox configuration file ~/.hphp*

If you have `hhvm.sandbox.home set`, `default.xxx` can be relative to that directory (remembering that a `user` is appended to what you set as `hhvm.sandbox.home`). For example, below, if we had `hhvm.sandbox.home = /home`, then we could set `default.path` to `sites/www`.

The `default.ServerVars.ANY_SERVER_VARIABLE=1` is just an example.

```
default.path = /home/user/sites/www
default.log = /home/user/sites//error_log
default.accesslog = /home/user/logs/access_log
default.ServerVars.ANY_SERVER_VARIABLE=1

another_site.path = /home/user/sites/another-site
another_site.log = /home/user/sites/another-site/logs/error_log
another_site.accesslog = /home/user/sites/another-site/logs/access_log
```

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.sandbox.sandbox_mode` | `bool` | `false` | If enabled, sandbox mode is turned on; generally coincides with turning on [HHVM server debugging](#debugger).
| `hhvm.sandbox.home` | `string` | `''` | The home directory of your sandbox. e.g., If this is set to `/home`, then your sandbox path will be something like `/home/joelm/`.
| `hhvm.sandbox.conf_file` | `string` | `''` | The file which contains sandbox information like the path to the default sandbox, the path to other sandboxes, log paths, etc. You can use this file in conjunction with some of some of the other specific sandbox options. For example, if `hhvm.sandbox.home` is set, then this setting is *relative* to that path. 
| `hhvm.sandbox.pattern` | `string` | `''` | The URL pattern of your sandbox host. It is a generally a regex pattern with at least one capture group. For example `www.[user]-[sandbox].[machine].yourdomain.com` or `www.([^-]*(-[^-]*)?).yourdomain.com`
| `hhvm.sandbox.from_common_root` | `bool` | `false` | If enabled, your sandboxes will be created from a common root path. This root path is based upon the `hhvm.sandbox.pattern` that you specify and the value of it will be the root string before the first `.` in the pattern. If you have a pattern like `([^-]*(-[^-]*)?).localhost.com` which maps to a sandbox at `user-another_site.localhost.com`, the root that is established by enabling this setting is `/joelm-another_site`. This setting as `true` supercedes any setting you have for `hhvm.sandbox.conf_file`.
| `hhvm.sandbox.directories_root` | `string` | `''` | If you have `hhvm.sandbox.from_common_root` enabled, this value will be prepended to your common root.
| `hhvm.sandbox.logs_root` | `string` | `''` | If you have `hhvm.sandbox.from_common_root` enabled, this value will be prepended to your common root.
| `hhvm.sandbox.fallback` | `string` | `''` | If for some reason your home path in `hhvm.sandbox.home` cannot be accessed, this will be your fallback to set as your home path.
| `hhvm.sandbox.server_variables` | `map` | *empty* | Any server variables that you want accessible when running your sandbox.

## Debugger

A sandbox is commonly used in conjunction with [debugging](#debugger) to debug HHVM in [server mode](/hhvm/basic-usage/server). When you connect the debugger to a server mode process, you will be given the option of a sandbox on which to attach the debugger. The first option you will always see (and attach to by default) is the dummy sandbox, which has no document root. It is primarily used for real-time evaluation of code from the debugger prompt.

These options are used to allow you to use the `hphpd` debugger remotely via a sandbox. HHVM must be running in [server mode](/hhvm/basic-usage/server), as there needs to be a server process on which to attach.

These are the common `.ini` file options to set to enable HHVM to start a debugger in server mode. 

```
hhvm.sandbox.sandbox_mode=1
hhvm.sandbox.home=/home
hhvm.sandbox.conf_file=.hphp
hhvm.sandbox.pattern="([^-]*(-[^-]*)?)\.localhost\.com"
hhvm.debugger.enable_debugger = 1
hhvm.debugger.enable_debugger_server = 1
hhvm.debugger.default_sandbox_path = /path/to/your/sandbox
```

If you run your server as `hhvm -m server -c this.ini` and in another terminal, type `hhvm -m debug -h localhost`, you will see:

```
Welcome to HipHop Debugger!
Type "help" or "?" for a complete list of commands.

Connecting to localhost:8089...
Attaching to user's default sandbox and pre-loading, please wait...
localhost> m l
  1 user's default sandbox at /home/user/sites/www/
```

To start debugging:

```
localhost> break start
break start
Breakpoint 1 set start of request
localhost> continue
continue
```

Then you can make a web request via your browser or `curl` to your sandbox URL. You can set breakpoints in your sandbox code to stop at certain places of execution as well.

If you want to debug another sandbox instead of the default, you can explicitly specify the sandbox:

```
hhvm -m debug -h localhost --debug-sandbox another_site
```


| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.debugger.enable_debugger` | `bool` | `false` | You must set this to try in order for HHVM to listen to connections from the debugger.
| `hhvm.debugger.enable_debugger_server` | `bool` | `false` | This option is generally set in conjunction with `hhvm.debugger.enable_debugger` and actually allows for the listening to connections and remote debugging.
| `hhvm.debugger.default_sandbox_path` | `string` | `''` | Path to source files; similar to [`hhvm.server.source_root`](#common-options).
| `hhvm.debugger.disable_ipv6` | `bool` | `false` | If enabled, the debugger will only be able to communicate with ipv4 addresses (AF_INET).
| `hhvm.debugger.enable_debugger_color` | `bool` | `true` | Disable this if you do not want color in the debugger.
| `hhvm.debugger.enable_debugger_prompt` | `bool` | `true` | Disable this if you do not want a debugger prompt to be shown.
| `hhvm.debugger.enable_debugger_usage_log` | `bool` | `false` | *Currently this is only an internal setting*.
| `hhvm.debugger.port` | `int` | `8089` | The port on which debugger clients may connect.
| `hhvm.debugger.rpc.default_auth` | `string` | `''` | The password to be able to debug the HHVM server in RPC mode.
| `hhvm.debugger.rpc.default_port` | `int` | `8083` | The port on which commands will be sent to the server via RPC.
| `hhvm.debugger.rpc.default_timeout` | `int` | `30`| The timeout for commands to be available on the RPC port.
| `hhvm.debugger.rpc.host_domain` | `string` | `''` | The domain where your RPC server is hosted.
| `hhvm.debugger.signal_timeout` | `int` | `1` | The amount of time the debugger waits for a signal from the client before sending to a default dummy sandbox.
| `hhvm.debugger.startup_document` | `string` | `''` | The file that is executed before any other, when the server starts. Does not have to be the same your [default document](#common-options). Similar to `hhvm.server.startup_document`.
| `hhvm.bypass_access_check` | `bool` | `false` | If enabled, forces the debugger bypass access checks on class members.
| `hhvm.script_mode` | `bool` | `false` | If enabled, then the debugger is debugging in script mode.
| `hhvm.tutorial` | `bool` | `false` | If enabled, you can go through the debugger tutorial.
| `hhvm.tutorial.visited` | `bool` | `false` | If enabled, this will tell the debugger you have already seen the tutorial.
| `hhvm.print_level` | `int` | `5` | The amount of printing you want in the debugger.
| `hhvm.source_root` | `string` | `` | If explicitly set, then the debugger will look for source code there. Otherwise, it is where the debugger is running from.
| `hhvm.small_step` | | |
| `hhvm.stack_args` | | |
| `hhvm.max_code_lines` | | |
| `hhvm.utf8` | | |
| `hhvm.short_print_char_count` | | |
| `hhvm.macros` | | |
| `hhvm.never_save_config` | | |

## Error Handling

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.error_handling.assert_active | enable `assert()` evaluation | _False_ |
| hhvm.error_handling.assert_warning | issue a PHP warning for each failed assertion | _False_ |
| hhvm.error_handling.call_user_handler_on_fatals | Call a callback installed via `set_error_handler` when a fatal error occurs. | _False_ |
| hhvm.error_handling.enable_hip_hop_errors | | |
| hhvm.error_handling.max_loop_count | | |
| hhvm.error_handling.max_serialized_string_size | throw exception if unserializing a string greater than this amount | `64 * 1024 * 1024` (64 MB) |
| hhvm.error_handling.no_infinite_recursion_detection | do not raise error if infinite recursion is detected | _False_ |
| hhvm.error_handling.notice_frequency | log every N notices, where N is this number | 1 |
| hhvm.error_handling.throw_exception_on_bad_method_call | throw an error if calling a method on a non-object | _True_ |
| hhvm.error_handling.warn_too_many_arguments | | |
| hhvm.error_handling.warning_frequency | log every N warnings, where N is this number | 1 |
| hhvm.hack_array_warn_frequency | | |

## XML

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.libxml.ext_entity_whitelist` | | |
| `hhvm.simple_xml.empty_namespace_matches_all` | | |

## JIT Settings

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.jit | Enables the JIT | _False_ on Windows, _True_ elsewhere |
| hhvm.jit_always_interp_one | | |
| hhvm.jit_disabled_by_hphpd | | |
| hhvm.jit_enable_rename_function | If `false`, `rename_function()` will throw a fatal error. And HHVM knowing that functions cannot be renamed can increase performance. | _False_ |
| hhvm.jit_global_data_size | | |
| hhvm.jit_global_translation_limit | | |
| hhvm.jit_keep_dbg_files | | |
| hhvm.jit_llvm | Experimental LLVM backend, see [this blog post](http://hhvm.com/blog/10205/llvm-code-generation-in-hhvm) for more information | _False_ |
| hhvm.jit_loops | | |
| hhvm.jit_max_translations | Limits the number of translations allowed per `srckey`, and once this limit is hit any further retranslation requests will result in a call out to the interpreter. | 12 |
| hhvm.jit_no_gdb | | |
| hhvm.jit_pgo | | |
| hhvm.jit_pgo_hot_only | | |
| hhvm.jit_pgo_region_selector | | |
| hhvm.jit_pgo_release_vv_min_percent | | |
| hhvm.jit_pgo_threshold | | |
| hhvm.jit_pgo_use_post_conditions | | |
| hhvm.jit_profile_interp_requests | | |
| hhvm.jit_profile_path | | |
| hhvm.jit_profile_record | | |
| hhvm.jit_profile_requests | | |
| hhvm.jit_pseudomain | Whether or not to JIT pseudomains (code that doesn't exist inside a class) | _True_ |
| hhvm.jit_region_selector | | |
| hhvm.jit_relocation_size | | |
| hhvm.jit_require_write_lease | | |
| hhvm.jit_stress_lease | | |
| hhvm.jit_stress_type_pred_percent | | |
| hhvm.jit_target_cache_size | | |
| hhvm.jit_timer | | |
| hhvm.jit_trans_counters | | |
| hhvm.jit_type_prediction | | |
| hhvm.jit_unlikely_dec_ref_percent | | |
| hhvm.jit_use_vtune_api | | |

## JIT Translation Cache Size

The translation cache stores the JIT'd code. It's split into several sections depending on how often the code is (or is expected to be) executed. The sum of all the bits has to be less than 2GB.

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.jit_a_size | Size in bytes of main translation cache. | 62914560 (60 MB) |
| hhvm.jit_a_cold_size | Size of cold code cache. Code that is unlikely to be executed is deemed cold. (Recommended: 0.5x hhvm.jit_a_size) | 25165824 (24 MB) |
| hhvm.jit_a_frozen_size | Size of extremely cold code cache. Code that is almost never executed, or executed once and then freed up, is deemed frozen. (Recommended: 1x hhvm.jit_a_size) | 41943040 (40 MB)|
| hhvm.jit_a_hot_size | Size of hot code cache. (Enabled only in RepoAuthoritative mode) | 0 |
| hhvm.jit_a_prof_size | Size of profiling code cache. (Recommended: 1x hhvm.jit_a_size) | 67108864 (64 MB) |
| hhvm.jit_a_max_usage | Maximum amount of code to generate. (Recommended: 1x hhvm.jit_a_size)| 62914560 (60 MB) |
| hhvm.tc_num_huge_cold_mb | | |
| hhvm.tc_num_huge_hot_mb | | |

## APC Settings

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.server.apc.expire_on_sets | Enables item purging on expiration | _False_ |
| hhvm.server.apc.purge_frequency | Expired items will be purged every this many APC sets | 4096 |
| hhvm.server.apc.purge_rate | Evict at most this many items on each purge. No limit if -1. | -1 |

## Repo Authoritative

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.repo.authoritative | If `true`, you are specifying that you will be using HHVM's repo-authoritative mode to serve requests. | _False_ |
| hhvm.repo.central.path | The path to the hhvm.hhbc file created when you compiled a repo-authoritative repo. | `""` |
| hhvm.repo.commit | | |
| hhvm.repo.debug_info | | |
| hhvm.repo.journal | | |
| hhvm.repo.local.mode | | |
| hhvm.repo.local.path | | |
| hhvm.repo.mode | | |
| hhvm.repo.preload | | |
| hhvm.check_repo_auth_deserialize | | |
| hhvm.disable_some_repo_auth_notices | | |

## Statistics

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.stats.enable | enable stats collection | _False_ |
| hhvm.stats.apc | | _False_|
| hhvm.stats.enable_hot_profiler | enable xhprof | _True_ |
| hhvm.stats.max_slot | | _False_ |
| hhvm.stats.memcache | | _False_ |
| hhvm.stats.memcache_key | | |
| hhvm.stats.memory | | _False_ |
| hhvm.stats.network_io | | _False_ |
| hhvm.stats.profiler_max_trace_buffer | | |
| hhvm.stats.profiler_trace_buffer | | |
| hhvm.stats.profiler_trace_expansion | | |
| hhvm.stats.slot_duration | in seconds | 600 |
| hhvm.stats.sql | | _False_ |
| hhvm.stats.sql_table | | _False_ |
| hhvm.stats.web | | _False_ |
| hhvm.stats.xsl | | _False_ |
| hhvm.stats.xsl_proxy | | |

## Advanced Settings

These are settings that generally won't be used by most users of HHVM.

### Resources

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.resource_limit.drop_cache_cycle | | |
| hhvm.resource_limit.max_memcache_key_count | | |
| hhvm.resource_limit.max_rss | | |
| hhvm.resource_limit.max_rss_polling_cycle | | |
| hhvm.resource_limit.max_sql_row_count | | |
| hhvm.resource_limit.serialization_size_limit | | |
| hhvm.resource_limit.socket_default_timeout | | |
| hhvm.resource_limit.string_offset_limit | | |

### Regular Expressions

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.preg.backtrace_limit | | |
| hhvm.preg.error_log | | |
| hhvm.preg.recursion_limit | | |
| hhvm.pcre_table_size | | |

### HHIR

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.hhir_alloc_simd_regs | | |
| hhvm.hhir_bytecode_control_flow | | |
| hhvm.hhir_cse | | |
| hhvm.hhir_dead_code_elim | | |
| hhvm.hhir_direct_exit | | |
| hhvm.hhir_enable_callee_saved_opt | | |
| hhvm.hhir_enable_coalescing | | |
| hhvm.hhir_enable_gen_time_inlining | | |
| hhvm.hhir_enable_pre_coloring | | |
| hhvm.hhir_extra_opt_pass | | |
| hhvm.hhir_gen_opts | | |
| hhvm.hhir_generate_asserts | | |
| hhvm.hhir_inline_frame_opts | | |
| hhvm.hhir_inline_singletons | | |
| hhvm.hhir_inlining_max_cost | | |
| hhvm.hhir_inlining_max_depth | | |
| hhvm.hhir_inlining_max_return_dec_refs | | |
| hhvm.hhir_jump_opts | | |
| hhvm.hhir_num_free_regs | | |
| hhvm.hhir_prediction_opts | | |
| hhvm.hhir_refcount_opts | | |
| hhvm.hhir_refcount_opts_always_sink | | |
| hhvm.hhir_relax_guards | | |
| hhvm.hhir_simplification | | |
| hhvm.hhir_stress_codegen_blocks | | |
| hhvm.hhir_validate_ref_count | | |

### Xbox Server

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.xbox.default_local_timeout_milli_seconds | | |
| hhvm.xbox.default_remote_timeout_seconds | | |
| hhvm.xbox.process_message_func | | |
| hhvm.xbox.server_info.always_reset | | |
| hhvm.xbox.server_info.log_info | | |
| hhvm.xbox.server_info.max_duration | | |
| hhvm.xbox.server_info.max_queue_length | | |
| hhvm.xbox.server_info.max_request | | |
| hhvm.xbox.server_info.port | | |
| hhvm.xbox.server_info.request_init_document | | |
| hhvm.xbox.server_info.request_init_function | | |
| hhvm.xbox.server_info.thread_count | | |
| hhvm.xbox.server_info.warmup_document | | |

### Pagelet Server

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.pagelet_server.queue_limit | | |
| hhvm.pagelet_server.thread_count | This specifies the number of worker threads used to server web traffic in server mode. The number to set here is really quite experimental. If you use async, then this number can be the default. Otherwise, you might want a higher number. | 2x the number of CPU cores |
| hhvm.pagelet_server.thread_drop_cache_timeout_seconds | | |
| hhvm.pagelet_server.thread_drop_stack | | |
| hhvm.pagelet_server.thread_round_robin | | |

### Emitter

| Setting | Type | Default | Description
|---------|------|---------|------------
| `hhvm.emit_switch` | `bool` | `true` | Use when mangling the unit cache.
| `hhvm.enable_emitter_stats` | `bool` | `true` | Enable incrementing the emitter stat counter.
| `hhvm.random_hot_funcs` | | |

### Xenon

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.xenon.force_always_on | Gather PHP and async stacks at every function enter/exit. This will gather potentially large amounts of data and is mostly useful for small script debugging. | _False_ |
| hhvm.xenon.period | Configure Xenon to gather PHP and async stacks every this many seconds. | _0.0_ |

### Mail

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.mail.force_extra_parameters | | |
| hhvm.mail.sendmail_path | | |

### Code Checks

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.check_flush_on_user_close | Return error code is closing a stream in PHP did not flush the streams well | _True_ |
| hhvm.check_return_type_hints | Whether to check return type hints at runtime, and if so how. 0 means no return type checking. 1 - Raises E_WARNING if a return type hint fails.  2 - Raises E_RECOVERABLE_ERROR if regular return type hint fails, raises E_WARNING if soft return type hint fails. If a regular return type hint fails, it's possible for execution to resume normally if the user error handler doesn't throw and returns something other than boolean false. 3 - Same as 2, except if a regular type hint fails the runtime will not allow execution to resume normally; if the user error handler returns something other than boolean false, the runtime will throw a fatal error (this goes together with Option::HardReturnTypeHints) | 2 |
| hhvm.check_sym_link | Whether to follow symlinks when looking up units in the bytecode cache | _True_ |

### Profiling

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.profile_bc | | |
| hhvm.profile_heap_across_requests | | |
| hhvm.profile_hw_enable | | |
| hhvm.profile_hw_events | | |
| hhvm.hh_prof_server.allocation_profile | | |
| hhvm.hh_prof_server.enabled | | |
| hhvm.hh_prof_server.filter.min_alloc_per_req | | |
| hhvm.hh_prof_server.filter.min_bytes_per_req | | |
| hhvm.hh_prof_server.port | | |
| hhvm.hh_prof_server.profile_client_mode | | |
| hhvm.hh_prof_server.threads | | |
| hhvm.hh_prof_server.timeout_seconds | | |
| hhvm.record_code_coverage | turn on code coverage recording | _False_ |
| hhvm.code_coverage_output_file | specify an output file to store code coverage results at end of a script run | |
| hhvm.hot_func_count | | |
| hhvm.num_single_jit_requests | | |

### Proxies

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.proxy.origin | | |
| hhvm.proxy.percentage | | |
| hhvm.proxy.proxy_urls | | |
| hhvm.proxy.retry | | |
| hhvm.proxy.serve_urls | | |

### MySQL

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.mysql.typed_results | Zend returns strings and NULL only for MySQL results, not integers or floats. HHVM return ints (and, sometimes, actual doubles). This behavior can be disabled by setting TypedResults to false. | _True_ |
| hhvm.mysql.slow_query_threshold | | |

### Other

| Setting | Type | Default | Description
|---------|------|---------|------------
| hhvm.allow_hhas | Allow executing "hhas" files -- code written directly in HHBC. Directly writing HHBC can easily crash HHVM, and is rarely a useful thing to do anyways. | _False_ |
| hhvm.spin_on_crash | | |
| hhvm.simulate_arm | | |
| hhvm.timeouts_use_wall_time | Use walltime instead of cputime for timeouts | _False_|
| hhvm.dynamic_extension_path | path to look for extensions if a fully qualified path is not provided | |
| hhvm.gdb_sync_chunks | | |
| hhvm.hhbc_arena_chunk_size | | |
| hhvm.initial_named_entity_table_size | | |
| hhvm.initial_static_string_table_size | | |
| hhvm.map_hot_text_huge | | |
| hhvm.map_tc_huge | | |
| hhvm.map_tgt_cache_huge | | |
| hhvm.max_low_mem_huge_pages | | |
| hhvm.max_user_function_id | | |
| hhvm.vm_initial_global_table_size | | |
| hhvm.vm_stack_elms | | |

## Unused Settings

These are settings that are currently not used in the codebase.

| Setting | Type | Default |
|---------|------|---------|
| `hhvm.enable_alternative` | `int` | `0`
| `hhvm.server.enable_cuf_async` | `bool` | `false`
| `hhvm.server.enable_static_content_m_map` | `bool` | `true`
| `hhvm.server.lib_event_sync_send` | `bool` | `true` 
