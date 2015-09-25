The following example shows how to use `MCRouter::getOpName` to get the English readable name for an MCRouter operation given as an integer.

Here is the list of the current mappings:

```
("unknown",            0)
("echo",               1)
("quit",               2)
("version",            3)
("servererr",          4)
("get",                5)
("set",                6)
("add",                7)
("replace",            8)
("append",             9)
("prepend",           10)
("cas",               11)
("delete",            12)
("nops",              13)
("incr",              14)
("decr",              15)
("flushall",          16)
("flushre",           17)
("stats",             18)
("verbosity",         19)
("lease_get",         20)
("lease_set",         21)
("shutdown",          22)
("end",               23)
("metaget",           24)
("exec",              25)
("gets",              26)
("get_service_info",  27)
```
