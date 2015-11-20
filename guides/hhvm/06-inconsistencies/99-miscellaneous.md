HHVM does not support case-insensitive constants, for example:

@@ miscellaneous-examples/case-insensitive-constants.php @@

Difference: [https://3v4l.org/nCBh1](https://3v4l.org/nCBh1)

## get_defined_vars() and get_declared_classes()

HHVM may return variables/classes in a different order than PHP5.

Under different builds of HHVM, they will be consistent though.

## preg_replace /e.

HHVM and PHP 5.5+ has deprecated support for `preg_replace()` with the `/e` modifier. PHP 7 removes support of it completely. Use `preg_replace_callback()` instead.

## Converting $GLOBALS to bool 

Converting `$GLOBALS` to `bool` will always evaluate to `true`, even if `$GLOBALS` is empty. Converting to `bool` can mean an explicit cast, or an implicit conversion inside the condition of an if statement or similar.

## Fatals and continued execution

All fatals prevent further PHP code from executing, including `__destruct` methods. 

**Note**: `exit()` is a fatal.

## External Entities in LibXML

Loading of external entities in the libxml extension is disabled by default for security reasons. It can be re-enabled on a per-protocol basis (`file`, `http`, `compress.zlib`, etc...) with a comma-separated list in the ini setting
`hhvm.libxml.ext_entity_whitelist`.

## Local Variables containing a parameter

If the value of a local variable containing a parameter changes, `func_get_args()` returns the new value. This behavior matches PHP7, but not PHP5 (in PHP5, the original parameter value is used). 

Differences: [https://3v4l.org/OgFts](https://3v4l.org/OgFts)

@@ miscellaneous-examples/local-var-param.php @@

## PharData

Under HHVM, `PharData` will extract symlinks from tar files. PHP5 will create empty files instead.

## XDebug

XDebug defaults to using the time for naming the output file. PHP5 uses the PID instead.
