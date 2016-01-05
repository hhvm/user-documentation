<?hh

namespace Hack\UserDocumentation\Typechecker\Special\Examples\HHIE;

class A {
  // Normally if you use hh_client --lint hh_ignore_error.php without
  // the below HH_IGNORE_ERROR suppression comment, you will get a lint
  // error about using the uppercase TRUE.

  /* HH_IGNORE_ERROR[5001] We want to use uppercase TRUE */
  private bool $a = TRUE;
}
