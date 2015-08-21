<?hh

namespace Hack\UserDocumentation\Types\AdvancedRules\Examples\SuperGlobals;

function get_superglobal(string $s): array<string> {
  // If you try to use a variable that doesn't exist (e.g., $_NOEXIST), the
  // typechecker will thrown an undefined variable error.
  switch ($s) {
    case "_GET":
      return $_GET;
      break;
    case "_ENV":
      return $_ENV;
      break;
    case "_SERVER":
      return $_SERVER;
      break;
    default: // not supporting anything else
      return array();
  }
}

function sg(string $s): array<string> {
  return get_superglobal($s);
}

var_dump(sg("_SERVER"));
