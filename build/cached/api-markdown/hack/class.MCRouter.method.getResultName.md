``` yamlmeta
{
    "name": "getResultName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Translate an mc_res_* numeric code to something human-readable







``` Hack
public static function getResultName(
  int $op,
): string;
```




## Parameters




+ ` int $op `




## Returns




* ` string ` - - The name of the result




## Examples




The following example shows how to use ` MCRouter::getResultName ` to get the English readable name for an MCRouter result given as an integer.




Here is the list of the current mappings:




| Integer | Constant | String |
| - | - | - |
| 0 | MCRouter::mc_res_unknown | mc_res_unknown |
| 1 | MCRouter::mc_res_deleted | mc_res_deleted |
| 2 | MCRouter::mc_res_found | mc_res_found |
| 3 | MCRouter::mc_res_foundstale | mc_res_foundstale |
| 4 | MCRouter::mc_res_notfound | mc_res_notfound |
| 5 | MCRouter::mc_res_notfoundhot | mc_res_notfoundhot |
| 6 | MCRouter::mc_res_notstored | mc_res_notstored |
| 7 | MCRouter::mc_res_stalestored | mc_res_stalestored |
| 8 | MCRouter::mc_res_ok | mc_res_ok |
| 9 | MCRouter::mc_res_stored | mc_res_stored |
| 10 | MCRouter::mc_res_exists | mc_res_exists |
| 11 | MCRouter::mc_res_ooo | mc_res_ooo |
| 12 | MCRouter::mc_res_timeout | mc_res_timeout |
| 13 | MCRouter::mc_res_connect_timeout | mc_res_connect_timeout |
| 14 | MCRouter::mc_res_connect_error | mc_res_connect_error |
| 15 | MCRouter::mc_res_busy | mc_res_busy |
| 16 | MCRouter::mc_res_try_again | mc_res_try_again |
| 17 | MCRouter::mc_res_shutdown | mc_res_shutdown |
| 18 | MCRouter::mc_res_tko | mc_res_tko |
| 19 | MCRouter::mc_res_bad_command | mc_res_bad_command |
| 20 | MCRouter::mc_res_bad_key | mc_res_bad_key |
| 21 | MCRouter::mc_res_bad_flags | mc_res_bad_flags |
| 22 | MCRouter::mc_res_bad_exptime | mc_res_bad_exptime |
| 23 | MCRouter::mc_res_bad_lease_id | mc_res_bad_lease_id |
| 24 | MCRouter::mc_res_bad_cas_id | mc_res_bad_cas_id |
| 25 | MCRouter::mc_res_bad_value | mc_res_bad_value |
| 26 | MCRouter::mc_res_aborted | mc_res_aborted |
| 27 | MCRouter::mc_res_client_error | mc_res_client_error |
| 28 | MCRouter::mc_res_local_error | mc_res_local_error |
| 29 | MCRouter::mc_res_remote_error | mc_res_remote_error |
| 30 | MCRouter::mc_res_waiting | mc_res_waiting |
| 31 | MCRouter::mc_nres | mc_nres |







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/getResultName/001-basic-usage.php @@
<!-- HHAPIDOC -->
