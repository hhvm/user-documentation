<?hh // strict

namespace HHVM\UserDocumentation\_Private\SuperGlobals;

use namespace Facebook\TypeCoerce;

function environment_variables(): dict<string, string> {
  return TypeCoerce\match<dict<string, string>>(
    \HH\global_get('_ENV'),
  );
}

/**
 * This type is very big.
 * Add the keys that you need.
 * The more you add, the slower it becomes however.
 */
type TServerVariables = shape(
  'HTTP_HOST' => string,
  ...
);

function server_variables(): TServerVariables {
  return \HH\global_get('_SERVER') as TServerVariables;
}
