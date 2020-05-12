<?hh // strict

namespace HHVM\UserDocumentation\_Private\SuperGlobals;

use namespace Facebook\TypeCoerce;

function environment_variables(): dict<string, string> {
  return TypeCoerce\match<dict<string, string>>(\HH\global_get('_ENV'));
}
