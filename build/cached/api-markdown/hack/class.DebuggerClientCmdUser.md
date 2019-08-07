``` yamlmeta
{
    "name": "DebuggerClientCmdUser",
    "sources": [
        "api-sources/hhvm/hphp/hack/hhi/stdlib/builtins_debugger.hhi"
    ],
    "class": "DebuggerClientCmdUser"
}
```




## Interface Synopsis




``` Hack
class DebuggerClientCmdUser {...}
```




### Public Methods




+ [` ->__construct() `](</hack/reference/class/DebuggerClientCmdUser/__construct/>)
+ [` ->addCompletion($list) `](</hack/reference/class/DebuggerClientCmdUser/addCompletion/>)
+ [` ->arg($index, $str) `](</hack/reference/class/DebuggerClientCmdUser/arg/>)
+ [` ->argCount() `](</hack/reference/class/DebuggerClientCmdUser/argCount/>)
+ [` ->argValue($index) `](</hack/reference/class/DebuggerClientCmdUser/argValue/>)
+ [` ->args() `](</hack/reference/class/DebuggerClientCmdUser/args/>)
+ [` ->ask($format, ...$) `](</hack/reference/class/DebuggerClientCmdUser/ask/>)
+ [` ->code($source, $highlight_line = 0, $start_line_no = 0, $end_line_no = 0) `](</hack/reference/class/DebuggerClientCmdUser/code/>)
+ [` ->error($format, ...$) `](</hack/reference/class/DebuggerClientCmdUser/error/>)
+ [` ->getCode() `](</hack/reference/class/DebuggerClientCmdUser/getCode/>)
+ [` ->getCommand() `](</hack/reference/class/DebuggerClientCmdUser/getCommand/>)
+ [` ->getCurrentLocation() `](</hack/reference/class/DebuggerClientCmdUser/getCurrentLocation/>)
+ [` ->getFrame() `](</hack/reference/class/DebuggerClientCmdUser/getFrame/>)
+ [` ->getStackTrace() `](</hack/reference/class/DebuggerClientCmdUser/getStackTrace/>)
+ [` ->help($format, ...$) `](</hack/reference/class/DebuggerClientCmdUser/help/>)
+ [` ->helpBody($str) `](</hack/reference/class/DebuggerClientCmdUser/helpBody/>)
+ [` ->helpCmds($cmd, $desc, ...$) `](</hack/reference/class/DebuggerClientCmdUser/helpCmds/>)
+ [` ->helpSection($str) `](</hack/reference/class/DebuggerClientCmdUser/helpSection/>)
+ [` ->helpTitle($str) `](</hack/reference/class/DebuggerClientCmdUser/helpTitle/>)
+ [` ->info($format, ...$) `](</hack/reference/class/DebuggerClientCmdUser/info/>)
+ [` ->lineRest($index) `](</hack/reference/class/DebuggerClientCmdUser/lineRest/>)
+ [` ->output($format, ...$) `](</hack/reference/class/DebuggerClientCmdUser/output/>)
+ [` ->printFrame($index) `](</hack/reference/class/DebuggerClientCmdUser/printFrame/>)
+ [` ->quit() `](</hack/reference/class/DebuggerClientCmdUser/quit/>)
+ [` ->send($cmd) `](</hack/reference/class/DebuggerClientCmdUser/send/>)
+ [` ->tutorial($str) `](</hack/reference/class/DebuggerClientCmdUser/tutorial/>)
+ [` ->wrap($str) `](</hack/reference/class/DebuggerClientCmdUser/wrap/>)
+ [` ->xend($cmd) `](</hack/reference/class/DebuggerClientCmdUser/xend/>)
<!-- HHAPIDOC -->
