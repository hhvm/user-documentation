This module hosts a server on a local socket which can be used to execute
PHP scripts. The server will delegate file system operations as well as
proc_open commands to the client, allowing the server to masquerade as the
client user.

The main advantage here is that clients can share a single translation cache
and APC cache, and avoid paying the cost of hhvm startup with each script
invocation.

Using the CLI server requires no changes to the permission model of the
server, and as privileged access is delegated to clients the risk of
privilege escalation within the server is minimized. Additionally the server
itself is only accessible via local socket, but can share a translation
cache with requests executing via the webserver.

This server is still experimental and in particular there is very limited
transfer of configuration settings from the client. As a result scripts
executed via this module will be running with settings largely defined by
the server process. Currently `PHP_INI_USER`, `PHP_INI_ALL`, `ServerVariables`,
`EnvVariables`, and the remote environment are transferred.

Access to the CLI server can be controlled by the runtime options
`UnixServerAllowed{Users,Groups}`. When both arrays are empty all users will
be allowed, otherwise only enumerated users and users with membership in
enumerated groups will be permitted access.

Unit loading within the CLI server is controlled via two different runtime
options. Unlike ordinary file access the server will attempt to load all
units directly before falling back to the client.

When `UnixServerQuarantineUnits` is set units not opened directly by the server
process will be written to a per-user unit cache only used for CLI server
requests by that user.

When `UnixServerVerifyExeAccess` is set the server will verify that the client
can read each unit before loading them. The client is required to send the
server a read file descriptor for the unit, which the server will verify is
open in read mode using `fcntl`, has inode and device numbers matching those
seen by the server when executing stat.

A `UnixServerQuarantineApc` is also available, which forces all apc operations
performed by the CLI server to use a per user cache not shared with the
webserver.

The INI style runtime options are documented [here](/hhvm/configuration/INI-settings#cli-server).
