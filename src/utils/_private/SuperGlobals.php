<?hh // strict

namespace HHVM\UserDocumentation\_Private\SuperGlobals;

use namespace Facebook\{TypeAssert, TypeCoerce};

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
type TServerVarabies = shape(
  'HTTP_HOST' => string,
  ...
);

function server_variables(): TServerVarabies {
  return TypeCoerce\match<TServerVarabies>(\HH\global_get('_SERVER'));
}
