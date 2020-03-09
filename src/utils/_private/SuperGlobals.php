<?hh // strict

namespace HHVM\UserDocumentation\_Private\SuperGlobals;

use namespace Facebook\TypeAssert;

function environment_variables(): dict<string, arraykey> {
  return TypeAssert\matches<dict<string, arraykey>>(
    dict(\HH\global_get('_ENV') as KeyedContainer<_, _>),
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
