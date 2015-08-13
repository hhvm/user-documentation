<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\ScannedBase;
use FredEmmott\DefinitionFinder\ScannedFunctionAbstract;

abstract final class ScannedDefinitionFilters {
  public static function IsHHSpecific(ScannedBase $def): bool {
    $is_hh_specific =
      strpos($def->getName(), 'HH\\') === 0
      || strpos($def->getName(), '__SystemLib\\') === 0
      || $def->getAttributes()->containsKey('__HipHopSpecific')
      || strpos($def->getName(), 'fb_') === 0
      || strpos($def->getName(), 'hphp_') === 0;

    if ($is_hh_specific) {
      return true;
    }

    if (!$def instanceof ScannedFunctionAbstract) {
      return false;
    }

    if ($def->getReturnType()?->getTypeName() === 'Awaitable') {
      return true;
    }

    if (count($def->getGenericTypes()) > 0) {
      return true;
    }

    return false;
  }

  public static function ShouldNotDocument(ScannedBase $def): bool {
    return strpos($def->getName(), "__SystemLib\\") === 0;
  }
}
