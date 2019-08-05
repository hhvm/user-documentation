<?hh // strict
/*
 *  Copyright (c) 2004-present, Facebook, Inc.
 *  All rights reserved.
 *
 *  This source code is licensed under the BSD-style license found in the
 *  LICENSE file in the root directory of this source tree. An additional grant
 *  of patent rights can be found in the PATENTS file in the same directory.
 *
 */

namespace HHVM\UserDocumentation;

use type Facebook\DefinitionFinder\{
  HasScannedGenerics,
  ScannedClassish,
  ScannedDefinition,
  ScannedFunction,
  ScannedFunctionish,
};

use namespace HH\Lib\{C, Regex, Str};

abstract final class ScannedDefinitionFilters {
  public static function isHHSpecific(ScannedDefinition $def): bool {
    $normalized_name = $def->getName()
      |> Str\lowercase($$)
      |> Regex\replace($$, re"/[^a-z0-9]/", '-');

    if (
      $def is ScannedClassish
         && !C\contains_key(self::getPHPList('classes'), $normalized_name)
      || $def is ScannedFunction
         && !C\contains_key(self::getPHPList('functions'), $normalized_name)
    ) {
      // Function/class does not exist in PHP.
      return true;
    }

    // At this point, we know the function/class exists in PHP, but the HHVM
    // version might be sufficiently different (e.g. uses generics) to warrant
    // inclusion in the HHVM docs anyway.

    if (C\contains_key($def->getAttributes(), '__HipHopSpecific')) {
      return true;
    }

    if ($def is HasScannedGenerics && $def->getGenericTypes()) {
      return true;
    }

    if ($def is ScannedClassish) {
      foreach ($def->getMethods() as $method) {
        if (self::isHHSpecific($method)) {
          return true;
        }
      }
    }

    if (!$def is ScannedFunctionish) {
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

  <<__Memoize>>
  private static function getPHPList(string $type): keyset<string> {
    return Str\format('%s/api-php/php-%s.list', LocalConfig::ROOT, $type)
      |> \file_get_contents($$)
      |> Str\trim($$)
      |> Str\split($$, "\n")
      |> keyset($$);
  }

  public static function shouldNotDocument(ScannedDefinition $def): bool {
    return (
      Str\starts_with($def->getName(), '_') // non-namespaced name starts with _
      || Str\contains($def->getName(), '\\_') // namespaced name starts with _
      || Str\contains($def->getName(), 'WaitHandle')
      || Str\contains($def->getName(), "\\Rx\\")
      || ($def->getAttributes()['NoDoc'] ?? null) !== null
      || self::isBlacklisted($def)
      || (
        Str\contains($def->getFileName(), 'api-sources/hhvm/')
        && self::isUndefinedFunction($def)
      )
      || (
        Str\starts_with($def->getName(), 'Lazy')
        && Str\contains($def->getName(), 'Itera')
      )
    );
  }

  private static function isUndefinedFunction(ScannedDefinition $def): bool {
    if (!$def is ScannedFunction) {
      return false;
    }
    if (self::isHHSpecific($def)) {
      return false;
    }
    $path = $def->getFileName();
    if (!(
      Str\starts_with($path, BuildPaths::HHVM_TREE)
      && Str\ends_with($path, '.hhi')
    )) {
      return false;
    }
    $name = $def->getName();
    if (
      \function_exists($name, /* autoload = */ false)
      || \function_exists("HH\\".$name, /* autoload = */ false)
    ) {
      return false;
    }
    Log::w("\nUndefined function: ".$def->getName());
    return true;
  }

  private static function isBlacklisted(ScannedDefinition $def): bool {
    // In an ideal world, everything in HH\ should be documented,
    // nothing else should be. Things currently there that are internal
    // should be moved to the __SystemLib\ namespace.
    //
    // That's long-term cleanup unlikely to be finished soon and we don't
    // want to block the doc site rewrite on it, so, for now, we have
    // this blacklist.
    //
    // As meta points:
    //  - The xxxAccess interfaces for collections are covered by things like
    //    ConstSet, ConstMap, etc. The others are implementation details.

    // Do not include "HH\" in the blacklist - we automatically strip it.

    $blacklist = [
      /////////////
      // Classes //
      /////////////

      'AppendIterator',
      'ArrayIterator',
      'BuiltinEnum',
      'CachingIterator',
      'CallbackFilterIterator',
      'Client\TypecheckResult',
      'EmptyIterator',
      'FilterIterator',
      'Generator',
      'InfiniteIterator',
      'IntlIterator',
      'IteratorIterator',
      'LimitIterator',
      'MapIterator',
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
      'SetIterator',
      'SplDoublyLinkedList',
      'SplFixedArray',
      'SplHeap',
      'SplMaxHeap',
      'SplMinHeap',
      'SplObjectStorage',
      'SplPriorityQueue',
      'SplQueue',
      'SplStack',
      'VectorIterator',
      'WaitHandle',

      //////////////////////////
      // Not Actually Classes //
      //////////////////////////

      'dict',
      'keyset',
      'vec',

      ////////////////
      // Interfaces //
      ////////////////

      'ArrayAccess',
      'IteratorAggregate',
      'OuterIterator',
      'RecursiveIterator',
      'SQLListFormatter',
      'SQLScalarFormatter',
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
      'type_structure',
      'uasort',
      'uksort',
      'usort',
    ];
    $keyed = \array_flip($blacklist);

    $name = $def->getName();
    if (\strpos($name, "HH\\") === 0) {
      $name = \substr($name, 3);
    }

    return \array_key_exists($name, $keyed);
  }
}
