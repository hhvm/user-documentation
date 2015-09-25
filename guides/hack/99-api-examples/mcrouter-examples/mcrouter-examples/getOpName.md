The following example shows how to use `MCRouter::getOpName` to get the English readable name for an MCRouter operation given as an integer.

Here is the list of the current mappings:

Integer | String
--------|-------
0 | unknown
1 | echo
2 | quit
3 | version
4 | servererr
5 | get
6 | set
7 | add
8 | replace
9 | append
10 | prepend
11 | cas
12 | delete
13 | nops
14 | incr
15 | decr
16 | flushall
17 | flushre
18 | stats
19 | verbosity
20 | lease-get
21 | lease-set
22 | shutdown
23 | end
24 | metaget
25 | exec
26 | gets
27 | get-service-info
