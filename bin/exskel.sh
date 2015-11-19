#!/bin/sh

# To run 
# % exskel.sh example-name # without the .php extension
# e.g.,
# % exskel.sh use-vector
 
echo -en "<?hh\n\nnamespace Hack\UserDocumentation\TOPIC\SUBTOPIC\\\Examples\XXXXX;\n" > "$1.php"
touch "$1.php.hhvm.expectf"
echo "No errors!" > "$1.php.typechecker.expect"
touch "$1.php.hhconfig"
