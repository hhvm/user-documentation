``` yamlmeta
{
    "name": "getOpName",
    "sources": [
        "api-sources/hhvm/hphp/runtime/ext/mcrouter/ext_mcrouter.php",
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_mcrouter.hhi"
    ],
    "class": "MCRouter"
}
```




Translate an mc_op_* numeric code to something human-readable







``` Hack
public static function getOpName(
  int $op,
): string;
```




## Parameters




+ ` int $op `




## Returns




* ` string ` - - The name of the op




## Examples




The following example shows how to use ` MCRouter::getOpName ` to get the English readable name for an MCRouter operation given as an integer.




Here is the list of the current mappings:




| Integer | Constant | Returned String |
| - | - | - |
| 0 | MCRouter::mc_op_unknown | unknown |
| 1 | MCRouter::mc_op_echo | echo |
| 2 | MCRouter::mc_op_quit | quit |
| 3 | MCRouter::mc_op_version | version |
| 4 | MCRouter::mc_op_servererr | servererr |
| 5 | MCRouter::mc_op_get | get |
| 6 | MCRouter::mc_op_set | set |
| 7 | MCRouter::mc_op_add | add |
| 8 | MCRouter::mc_op_replace | replace |
| 9 | MCRouter::mc_op_append | append |
| 10 | MCRouter::mc_op_prepend | prepend |
| 11 | MCRouter::mc_op_cas | cas |
| 12 | MCRouter::mc_op_delete | delete |
| 13 | MCRouter::mc_op_nops | nops |
| 14 | MCRouter::mc_op_incr | incr |
| 15 | MCRouter::mc_op_decr | decr |
| 16 | MCRouter::mc_op_flushall | flushall |
| 17 | MCRouter::mc_op_flushre | flushre |
| 18 | MCRouter::mc_op_stats | stats |
| 19 | MCRouter::mc_op_verbosity | verbosity |
| 20 | MCRouter::mc_op_lease_get | lease-get |
| 21 | MCRouter::mc_op_lease_set | lease-set |
| 22 | MCRouter::mc_op_shutdown | shutdown |
| 23 | MCRouter::mc_op_end | end |
| 24 | MCRouter::mc_op_metaget | metaget |
| 25 | MCRouter::mc_op_exec | exec |
| 26 | MCRouter::mc_op_gets | gets |
| 27 | MCRouter::mc_op_get_service_info | get-service-info |







@@ /home/jjergus/work/code/user-documentation-jjergus/api-examples/class.MCRouter/getOpName/001-basic-usage.php @@
<!-- HHAPIDOC -->
