# HHVM INI Settings

Here is the raw list of all possible ini settings that can go in your `/etc/hhvm/php.ini`, `/etc/hhvm/server.ini` or any custom `.ini` file. Not all of them are useful to the HHVM end user. There is lots of cleanup work to do here, but for now you get sorted lists.

The lists below are just the HHVM-specific options. Many [standard PHP options](http://php.net/manual/en/ini.list.php) are also supported by HHVM, meaning the same thing that they do in PHP5 or PHP 7.

## Admin Server

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.admin_server.password | A password required for all requests to the admin server, other than the index. Is passed to the request as the `auth` request var. | _empty string_ |
| hhvm.admin_server.port | The port the admin server should listen on. If set to 0, the admin server is not started. | 0 |
| hhvm.admin_server.thread_count | The number of threads the admin server should use. | 1 |

## Debugger

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.debugger.default_sandbox_path | | |
| hhvm.debugger.disable_ipv6 | | |
| hhvm.debugger.enable_debugger | | |
| hhvm.debugger.enable_debugger_color | | |
| hhvm.debugger.enable_debugger_prompt | | |
| hhvm.debugger.enable_debugger_server | | |
| hhvm.debugger.enable_debugger_usage_log | | |
| hhvm.debugger.port | | |
| hhvm.debugger.rpc.default_auth | | |
| hhvm.debugger.rpc.default_port | | |
| hhvm.debugger.rpc.default_timeout | | |
| hhvm.debugger.rpc.host_domain | | |
| hhvm.debugger.signal_timeout | | |
| hhvm.debugger.startup_document | | |

## Feature flags

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.enable_alternative | | |
| hhvm.enable_args_in_backtraces | | |
| hhvm.enable_asp_tags | | |
| hhvm.enable_emit_switch | | |
| hhvm.enable_emitter_stats | | |
| hhvm.enable_hip_hop_experimental_syntax | | |
| hhvm.enable_numa | | |
| hhvm.enable_numa_local | | |
| hhvm.enable_obj_destruct_call | | |
| hhvm.enable_short_tags | | |
| hhvm.enable_xhp | Enable XHP support in PHP files. (XHP is always enabled in Hack files.) | _False_ |
| hhvm.enable_zend_compat | Enable the support layer for Zend PHP extensions. | _False_ |
| hhvm.enable_zend_sorting | Enable the support for Zend PHP alike sort stability | _False_ |
| hhvm.force_hh | Treat all code as Hack, even if it starts with `<?php`. This is a sort of "master option" -- several other behavioral options have their defaults to be whatever this option is set to. See below. | _False_ |

## JIT Translation Cache Size

The translation cache stores the JIT'd code. It's split into several sections depending on how often the code is (or is expected to be) executed.

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.jit_a_size | Size in bytes of main translation cache. | 62914560 (60 MB) |
| hhvm.jit_a_cold_size | Size of cold code cache. Code that is unlikely to be executed is deemed cold. (Recommended: 0.5x hhvm.jit_a_size) | 25165824 (24 MB) |
| hhvm.jit_a_frozen_size | Size of extremely cold code cache. Code that is almost never executed, or executed once and then freed up, is deemed frozen. (Recommended: 1x hhvm.jit_a_size) | 41943040 (40 MB)|
| hhvm.jit_a_hot_size | Size of hot code cache. (Enabled only in RepoAuthoritative mode) | 0 |
| hhvm.jit_a_prof_size | Size of profiling code cache. (Recommended: 1x hhvm.jit_a_size) | 67108864 (64 MB) |
| hhvm.jit_a_max_usage | Maximum amount of code to generate. (Recommended: 1x hhvm.jit_a_size)| 62914560 (60 MB) |

## JIT Settings

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.jit | Enables the JIT | _False_ on Windows, _True_ elsewhere |
| hhvm.jit_always_interp_one | | |
| hhvm.jit_disabled_by_hphpd | | |
| hhvm.jit_enable_rename_function | | |
| hhvm.jit_global_data_size | | |
| hhvm.jit_global_translation_limit | | |
| hhvm.jit_keep_dbg_files | | |
| hhvm.jit_llvm | | |
| hhvm.jit_loops | | |
| hhvm.jit_max_translations | | |
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
| hhvm.jit_pseudomain | | |
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

## APC Settings

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.server.apc.expire_on_sets | Enables item purging on expiration | _False_ |
| hhvm.server.apc.purge_frequency | Expired items will be purged every this many APC sets | 4096 |
| hhvm.server.apc.purge_rate | Evict at most this many items on each purge. No limit if -1. | -1 |

## Other

| INI Setting | Documentation | Default |
|-------------|---------------|---------|
| hhvm.allow_hhas | Allow executing "hhas" files -- code written directly in HHBC. Directly writing HHBC can easily crash HHVM, and is rarely a useful thing to do anyways. | _False_ |
| hhvm.authoritative_mode | | |
| hhvm.bypass_access_check | | |
| hhvm.check_flush_on_user_close | | |
| hhvm.check_repo_auth_deserialize | | |
| hhvm.check_return_type_hints | | |
| hhvm.check_sym_link | | |
| hhvm.code_coverage_output_file | | |
| hhvm.color | | |
| hhvm.debug.clear_input_on_success | | |
| hhvm.debug.core_dump_email | | |
| hhvm.debug.core_dump_report | | |
| hhvm.debug.core_dump_report_directory | | |
| hhvm.debug.full_backtrace | | |
| hhvm.debug.local_memcache | | |
| hhvm.debug.memcache_read_only | | |
| hhvm.debug.native_stack_trace | | |
| hhvm.debug.profiler_output_dir | | |
| hhvm.debug.record_input | | |
| hhvm.debug.server_error_message | send the error message to the output stream - corresponds to "display_errors" in PHP | |
| hhvm.debug.simple_counter.sample_stack_count | | |
| hhvm.debug.simple_counter.sample_stack_depth | | |
| hhvm.debug.translate_leak_stack_trace | | |
| hhvm.debug.translate_source | | |
| hhvm.disable_some_repo_auth_notices | | |
| hhvm.dump_ast | | |
| hhvm.dump_bytecode | Before executing a PHP file, dump out its HHBC along with some interesting metadata, then continue executing the file. Useful only for debugging. | _False_ |
| hhvm.dump_hhas | Instead of executing a PHP file, dump out an hhas file and exit. Useful for debugging, or if you need to directly write some hhas and need an easy way to get started. | _False_ |
| hhvm.dump_ring_buffer_on_crash | | |
| hhvm.dump_tc | | |
| hhvm.dump_tc_anchors | | |
| hhvm.dynamic_extension_path | | |
| hhvm.error_handling.assert_active | | |
| hhvm.error_handling.assert_warning | | |
| hhvm.error_handling.call_user_handler_on_fatals | Call a callback installed via `set_error_handler` when a fatal error occurs. | _False_ |
| hhvm.error_handling.enable_hip_hop_errors | | |
| hhvm.error_handling.max_loop_count | | |
| hhvm.error_handling.max_serialized_string_size | | |
| hhvm.error_handling.no_infinite_recursion_detection | | |
| hhvm.error_handling.notice_frequency | | |
| hhvm.error_handling.throw_exception_on_bad_method_call | | |
| hhvm.error_handling.warn_too_many_arguments | | |
| hhvm.error_handling.warning_frequency | | |
| hhvm.gdb_sync_chunks | | |
| hhvm.hack.lang.ints_overflow_to_ints | Don't check if integer arithmetic might overflow, just use asm intrinsics and do whatever the underlying processor would do, most likely a twos-complement wraparound. If unset, then check for integer overflow, and promote up to a float if so. (Skipping the check is considerably faster.) | Value of hhvm.force_hh |
| hhvm.hack.lang.look_for_typechecker | Make sure that Hack code is under a directory with a `.hhconfig` file, and error otherwise. | Inverse of value of hhvm.force_hh |
| hhvm.hack_array_warn_frequency | | |
| hhvm.hh_prof_server.allocation_profile | | |
| hhvm.hh_prof_server.enabled | | |
| hhvm.hh_prof_server.filter.min_alloc_per_req | | |
| hhvm.hh_prof_server.filter.min_bytes_per_req | | |
| hhvm.hh_prof_server.port | | |
| hhvm.hh_prof_server.profile_client_mode | | |
| hhvm.hh_prof_server.threads | | |
| hhvm.hh_prof_server.timeout_seconds | | |
| hhvm.hhbc_arena_chunk_size | | |
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
| hhvm.hot_func_count | | |
| hhvm.http.default_timeout | | |
| hhvm.http.slow_query_threshold | | |
| hhvm.initial_named_entity_table_size | | |
| hhvm.initial_static_string_table_size | | |
| hhvm.keep_perf_pid_map | | |
| hhvm.log.access_log_default_format | | |
| hhvm.log.admin_log.file | | |
| hhvm.log.admin_log.format | | |
| hhvm.log.admin_log.sym_link | | |
| hhvm.log.always_escape_log | | |
| hhvm.log.always_log_unhandled_exceptions | Unhandled exceptions are PHP fatal errors, and AlwaysLogUnhandledExceptions will make sure they get logged even if a user’s error handler is installed for them. | true |
| hhvm.log.drop_cache_chunk_size | | |
| hhvm.log.file | | |
| hhvm.log.header | | |
| hhvm.log.header_mangle | | |
| hhvm.log.level | | |
| hhvm.log.max_messages_per_request | | |
| hhvm.log.native_stack_trace | | |
| hhvm.log.no_silencer | | |
| hhvm.log.runtime_error_reporting_level | (numeric) corresponds to "error_reporting" in PHP | 8191 = E_ALL |
| hhvm.log.sym_link | | |
| hhvm.log.use_cronolog | | |
| hhvm.log.use_log_file | | |
| hhvm.log.use_request_log | | |
| hhvm.log.use_syslog | | |
| hhvm.macros | | |
| hhvm.mail.force_extra_parameters | | |
| hhvm.mail.sendmail_path | | |
| hhvm.map_hot_text_huge | | |
| hhvm.map_tc_huge | | |
| hhvm.map_tgt_cache_huge | | |
| hhvm.max_cloned_closures | | |
| hhvm.max_code_lines | | |
| hhvm.max_low_mem_huge_pages | | |
| hhvm.max_user_function_id | | |
| hhvm.mysql.typed_results | | |
| hhvm.mysql.slow_query_threshold | | |
| hhvm.never_save_config | | |
| hhvm.num_single_jit_requests | | |
| hhvm.pagelet_server.queue_limit | | |
| hhvm.pagelet_server.thread_count | | |
| hhvm.pagelet_server.thread_drop_cache_timeout_seconds | | |
| hhvm.pagelet_server.thread_drop_stack | | |
| hhvm.pagelet_server.thread_round_robin | | |
| hhvm.pcre_table_size | | |
| hhvm.perf_data_map | | |
| hhvm.perf_pid_map | | |
| hhvm.preg.backtrace_limit | | |
| hhvm.preg.error_log | | |
| hhvm.preg.recursion_limit | | |
| hhvm.print_level | | |
| hhvm.profile_bc | | |
| hhvm.profile_heap_across_requests | | |
| hhvm.profile_hw_enable | | |
| hhvm.profile_hw_events | | |
| hhvm.proxy.origin | | |
| hhvm.proxy.percentage | | |
| hhvm.proxy.proxy_urls | | |
| hhvm.proxy.retry | | |
| hhvm.proxy.serve_urls | | |
| hhvm.random_hot_funcs | | |
| hhvm.record_code_coverage | | |
| hhvm.repo.authoritative | | |
| hhvm.repo.central.path | | |
| hhvm.repo.commit | | |
| hhvm.repo.debug_info | | |
| hhvm.repo.journal | | |
| hhvm.repo.local.mode | | |
| hhvm.repo.local.path | | |
| hhvm.repo.mode | | |
| hhvm.repo.preload | | |
| hhvm.resource_limit.drop_cache_cycle | | |
| hhvm.resource_limit.max_memcache_key_count | | |
| hhvm.resource_limit.max_rss | | |
| hhvm.resource_limit.max_rss_polling_cycle | | |
| hhvm.resource_limit.max_sql_row_count | | |
| hhvm.resource_limit.serialization_size_limit | | |
| hhvm.resource_limit.socket_default_timeout | | |
| hhvm.resource_limit.string_offset_limit | | |
| hhvm.runtime_type_profile | | |
| hhvm.runtime_type_profile_logging_freq | | |
| hhvm.sandbox.conf_file | | |
| hhvm.sandbox.directories_root | | |
| hhvm.sandbox.fallback | | |
| hhvm.sandbox.from_common_root | | |
| hhvm.sandbox.home | | |
| hhvm.sandbox.logs_root | | |
| hhvm.sandbox.sandbox_mode | | |
| hhvm.script_mode | | |
| hhvm.server.allow_duplicate_cookies | | |
| hhvm.server.allowed_exec_cmds | Only effective if `hhvm.server.whitelist_exec` is true. | |
| hhvm.server.always_populate_raw_post_data | | |
| hhvm.server.always_use_relative_path | | |
| hhvm.server.backlog | | |
| hhvm.server.connection_limit | | |
| hhvm.server.connection_timeout_seconds | | |
| hhvm.server.dangling_wait | | |
| hhvm.server.default_charset_name | | |
| hhvm.server.default_document | | |
| hhvm.server.default_server_name_suffix | | |
| hhvm.server.dns_cache.enable | Whether HHVM should cache DNS lookups. | _False_ |
| hhvm.server.dns_cache.ttl | TTL for DNS cache entries. | 600 |
| hhvm.server.enable_cuf_async | | |
| hhvm.server.enable_early_flush | | |
| hhvm.server.enable_keep_alive | | |
| hhvm.server.enable_magic_quotes_gpc | | |
| hhvm.server.enable_on_demand_uncompress | | |
| hhvm.server.enable_output_buffering | | |
| hhvm.server.enable_ssl | | |
| hhvm.server.enable_static_content_from_disk | | |
| hhvm.server.enable_static_content_m_map | | |
| hhvm.server.error_document404 | | |
| hhvm.server.error_document500 | | |
| hhvm.server.evil_shutdown | | |
| hhvm.server.exit_on_bind_fail | | |
| hhvm.server.expires_active | | |
| hhvm.server.expires_default | | |
| hhvm.server.expose_hphp | | |
| hhvm.server.expose_xfb_debug | | |
| hhvm.server.expose_xfb_server | | |
| hhvm.server.fatal_error_message | | |
| hhvm.server.file_cache | | |
| hhvm.server.file_socket | | |
| hhvm.server.fix_path_info | | |
| hhvm.server.forbidden_as404 | | |
| hhvm.server.force_chunked_encoding | | |
| hhvm.server.force_compression.cookie | | |
| hhvm.server.force_compression.param | | |
| hhvm.server.force_compression.url | | |
| hhvm.server.force_server_name_to_header | | |
| hhvm.server.graceful_shutdown_wait | | |
| hhvm.server.gzip_compression_level | | |
| hhvm.server.harsh_shutdown | | |
| hhvm.server.host | | |
| hhvm.server.http_safe_mode | | |
| hhvm.server.image_memory_max_bytes | | |
| hhvm.server.implicit_flush | | |
| hhvm.server.ip | | |
| hhvm.server.kill_on_sigterm | | |
| hhvm.server.lib_event_sync_send | | |
| hhvm.server.light_process_count | | |
| hhvm.server.light_process_file_prefix | | |
| hhvm.server.lock_code_memory | | |
| hhvm.server.max_array_chain | | |
| hhvm.server.max_post_size | | |
| hhvm.server.memory_head_room | | |
| hhvm.server.output_handler | | |
| hhvm.server.path_debug | | |
| hhvm.server.port | | |
| hhvm.server.prod_server_port | | |
| hhvm.server.psp_timeout_seconds | | |
| hhvm.server.request_body_read_limit | | |
| hhvm.server.request_init_document | | |
| hhvm.server.request_init_function | | |
| hhvm.server.request_memory_max_bytes | | |
| hhvm.server.request_timeout_seconds | | |
| hhvm.server.response_queue_count | | |
| hhvm.server.safe_file_access | | |
| hhvm.server.shutdown_listen_no_work | | |
| hhvm.server.shutdown_listen_wait | | |
| hhvm.server.ssl_certificate_dir | | |
| hhvm.server.ssl_certificate_file | | |
| hhvm.server.ssl_certificate_key_file | | |
| hhvm.server.ssl_port | | |
| hhvm.server.startup_document | | |
| hhvm.server.stat_cache | | |
| hhvm.server.takeover_filename | | |
| hhvm.server.thread_count | Number of worker threads serving web requests | 2 * number of CPUs |
| hhvm.server.thread_drop_cache_timeout_seconds | | |
| hhvm.server.thread_drop_stack | | |
| hhvm.server.thread_job_lifo_switch_threshold | | |
| hhvm.server.thread_job_max_queuing_milli_seconds | | |
| hhvm.server.thread_round_robin | | |
| hhvm.server.tls_client_cipher_spec | | |
| hhvm.server.tls_disable_tls1_2 | | |
| hhvm.server.type | | |
| hhvm.server.unserialization_whitelist_check | | |
| hhvm.server.unserialization_whitelist_check_warning_only | | |
| hhvm.server.upload.enable_file_uploads | | |
| hhvm.server.upload.enable_upload_progress | | |
| hhvm.server.upload.rfc1867freq | | |
| hhvm.server.upload.rfc1867name | | |
| hhvm.server.upload.rfc1867prefix | | |
| hhvm.server.upload.upload_max_file_size | | |
| hhvm.server.upload.upload_tmp_dir | | |
| hhvm.server.use_direct_copy | | |
| hhvm.server.user | | |
| hhvm.server.utf8ize_replace | | |
| hhvm.server.warmup_document | | |
| hhvm.server.warmup_throttle_request_count | | |
| hhvm.server.warn_on_collection_to_array | | |
| hhvm.server.whitelist_exec | | |
| hhvm.server.whitelist_exec_warning_only | | |
| hhvm.server.xfb_debug_ssl_key | | |
| hhvm.short_print_char_count | | |
| hhvm.simple_xml.empty_namespace_matches_all | | |
| hhvm.simulate_arm | | |
| hhvm.small_step | | |
| hhvm.source_root | | |
| hhvm.spin_on_crash | | |
| hhvm.stack_args | | |
| hhvm.static_file.extensions[ ] | Map of filename extensions to content types for use by the Proxygen server | see [runtime-option.cpp](https://gist.github.com/JoelMarcey/29601dc033af31390fc6) for defaults |
| hhvm.stats.enable | | |
| hhvm.stats.apc | | |
| hhvm.stats.enable_hot_profiler | | |
| hhvm.stats.max_slot | | |
| hhvm.stats.memcache | | |
| hhvm.stats.memcache_key | | |
| hhvm.stats.memory | | |
| hhvm.stats.network_io | | |
| hhvm.stats.profiler_max_trace_buffer | | |
| hhvm.stats.profiler_trace_buffer | | |
| hhvm.stats.profiler_trace_expansion | | |
| hhvm.stats.slot_duration | | |
| hhvm.stats.sql | | |
| hhvm.stats.sql_table | | |
| hhvm.stats.web | | |
| hhvm.stats.xsl | | |
| hhvm.stats.xsl_proxy | | |
| hhvm.tc_num_huge_cold_mb | | |
| hhvm.tc_num_huge_hot_mb | | |
| hhvm.timeouts_use_wall_time | | |
| hhvm.tutorial | | |
| hhvm.tutorial.visited | | |
| hhvm.utf8 | | |
| hhvm.vm_initial_global_table_size | | |
| hhvm.vm_stack_elms | | |
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
| hhvm.xenon.force_always_on | Gather PHP and async stacks at every function enter/exit. This will gather potentially large amounts of data and is mostly useful for small script debugging. | _False_ |
| hhvm.xenon.period | Configure Xenon to gather PHP and async stacks every this many seconds. | _0.0_ |
| hhvm.zend_executable | | |
| pid | PID file path | |
