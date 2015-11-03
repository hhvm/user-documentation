<?hh // strict

namespace HHVM\UserDocumentation;

use FredEmmott\DefinitionFinder\ScannedBase;
use FredEmmott\DefinitionFinder\ScannedClass;
use FredEmmott\DefinitionFinder\ScannedFunctionAbstract;
use FredEmmott\DefinitionFinder\HasScannedGenerics;

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

    if ($def instanceof HasScannedGenerics && $def->getGenericTypes()) {
      return true;
    }

    if ($def instanceof ScannedClass) {
      foreach ($def->getMethods() as $method) {
        if (self::IsHHSpecific($method)) {
          return true;
        }
      }
    }

    if (!$def instanceof ScannedFunctionAbstract) {
      return false;
    }

    if ($def->getReturnType()?->getTypeName() === 'Awaitable') {
      return true;
    }

    if (
      $def->getReturnType()?->getTypeName() === 'ExternalThreadEventWaitHandle'
    ) {
      return true;
    }

    return false;
  }

  public static function ShouldNotDocument(ScannedBase $def): bool {
    return
      (strpos($def->getName(), "__SystemLib\\") === 0)
      || self::IsBlacklisted($def);
  }

  private static function IsBlacklisted(ScannedBase $def): bool {
    // In an ideal world, everything in HH\ should be documented,
    // nothing else should be. Things currently there that are internal
    // should be moved to the __SystemLib\ namespace.
    //
    // That's long-term cleanup unlikely to be finished soon and we don't
    // want to block the doc site rewrite on it, so, for now, we have
    // this blacklist.
    $blacklist = [
      /////////////
      // Classes //
      /////////////

      'AppendIterator',
      'ArrayIterator',
      'CallbackFilterIterator',
      'EmptyIterator',
      'FilterIterator',
      'Generator',
      'HH\BuiltinEnum', // Should be __SystemLib\BuiltinEnum
      'InfiniteIterator',
      'IntlIterator',
      'IteratorIterator',
      'LimitIterator',
      'MultipleIterator',
      'MySSLContextProvider',
      'NoRewindIterator',
      'ParentIterator',
      'RecursiveArrayIterator',
      'RecursiveCachingIterator',
      'RecursiveCallbackFilterIterator',
      'RecursiveFilterIterator',
      'RecursiveIteratorIterator',
      'RecursiveRegexIterator',
      'RecursiveTreeIterator',
      'ReflectionFunctionAbstract',
      'RegexIterator',
      'ResourceBundle',
      'SessionHandler',
      'SplDoublyLinkedList',
      'SplFixedArray',
      'SplHeap',
      'SplMaxHeap',
      'SplMinHeap',
      'SplObjectStorage',
      'SplPriorityQueue',
      'SplQueue',
      'SplStack',

      ////////////////
      // Interfaces //
      ////////////////

      'ArrayAccess',
      'IndexAccess',
      'IteratorAggregate',
      'OuterIterator',
      'RecursiveIterator',
      'SeekableIterator',

      ///////////////
      // Functions //
      ///////////////

      'apache_get_config',
      'array_column',
      'array_fill',
      'array_filter',
      'array_key_exists',
      'array_keys',
      'array_values',
      'arsort',
      'asort',
      'call_use_func_array',
      'krsort',
      'ksort',
      'lz4_hccompress',
      'lz4compress',
      'lz4uncompress',
      'lzhccompress',
      'mysql_fetch_result',
      'nzcompress',
      'nzuncompress',
      'rsort',
      'snuncompress',
      'sort',
      'uasort',
      'uksort',
      'usort',
    ];
    return array_key_exists($def->getName(), array_flip($blacklist));
  }
}
