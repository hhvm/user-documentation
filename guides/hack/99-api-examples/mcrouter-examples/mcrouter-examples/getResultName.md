The following example shows how to use `MCRouter::getResultName` to get the English readable name for an MCRouter result given as an integer.

Here is the list of the current mappings:

Integer | String
--------|-------
0 | mc_res_unknown
1 | mc_res_deleted
2 | mc_res_found
3 | mc_res_foundstale
4 | mc_res_notfound
5 | mc_res_notfoundhot
6 | mc_res_notstored
7 | mc_res_stalestored
8 | mc_res_ok
9 | mc_res_stored
10 | mc_res_exists
11 | mc_res_ooo
12 | mc_res_timeout
13 | mc_res_connect_timeout
14 | mc_res_connect_error
15 | mc_res_busy
16 | mc_res_try_again
17 | mc_res_shutdown
18 | mc_res_tko
19 | mc_res_bad_command
20 | mc_res_bad_key
21 | mc_res_bad_flags
22 | mc_res_bad_exptime
23 | mc_res_bad_lease_id
24 | mc_res_bad_cas_id
25 | mc_res_bad_value
26 | mc_res_aborted
27 | mc_res_client_error
28 | mc_res_local_error
29 | mc_res_remote_error
30 | mc_res_waiting
31 | mc_nres
