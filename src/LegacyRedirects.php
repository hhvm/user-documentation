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

abstract final class LegacyRedirects {
  public static function getUrlForId(string $id): ?string {
    $ids = [$id, \strtr($id, '.', '-'), \strtr($id, '-', '.')];

    foreach ($ids as $id) {
      $url = self::getUrlForExactId($id);
      if ($url !== null) {
        return $url;
      }
    }

    return null;
  }

  private static function getUrlForExactId(string $id): ?string {
    // Since the API redirects are quite specific, see if we are redirecting
    // from there first.
    $url = idx(APILegacyRedirectData::getIndex(), $id);
    if ($url !== null) {
      return $url;
    }

    // If not, iterate through our manual redirects and see if we have
    // $from being a string part of $id. If so, then we can redirect to the
    // appropriate place.
    foreach (self::getManualRedirectData() as $from => $to) {
      if (\stripos($id, $from) !== false) {
        return $to;
      }
    }
    return null;
  }

  private static function getManualRedirectData(): Map<string, string> {
    return Map {
      'index' => '/',
      'hacklangref' => '/hack/',
      'asio.wrappedexception' =>
        '/hack/reference/class/HH.Asio.WrappedException/',
      'asio.wrappedresult' => '/hack/reference/class/HH.Asio.WrappedResult/',
      'asio.resultexceptionwrapper' =>
        '/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/',
      'asio.resultorexceptionwrapper' =>
        '/hack/reference/interface/HH.Asio.ResultOrExceptionWrapper/',
      'async.mysql.asyncmysqlclient' =>
        '/hack/reference/class/AsyncMysqlClient/',
      'async.mysql.asyncmysqlclientstats' =>
        '/hack/reference/class/AsyncMysqlClientStats/',
      'async.mysql.asyncmysqlconnectresult' =>
        '/hack/reference/class/AsyncMysqlConnectResult/',
      'async.mysql.asyncmysqlconnection' =>
        '/hack/reference/class/AsyncMysqlConnection/',
      'async.mysql.asyncmysqlconnectionpool' =>
        '/hack/reference/class/AsyncMysqlConnectionPool/',
      'async.mysql.asyncmysqlerrorresult' =>
        '/hack/reference/class/AsyncMysqlErrorResult/',
      'async.mysql.asyncmysqlqueryerrorresult' =>
        '/hack/reference/class/AsyncQueryErrorResult/',
      'async.mysql.asyncmysqlqueryresult' =>
        '/hack/reference/class/AsyncMysqlQueryResult/',
      'async.mysql.asyncmysqlrow' => '/hack/reference/class/AsyncMysqlRow/',
      'async.mysql.asyncmysqlrowblock' =>
        '/hack/reference/class/AsyncMysqlRowBlock/',
      'async.mysql.asyncmysqlrowblockiterator' =>
        '/hack/reference/class/AsyncMysqlRowBlockIterator/',
      'async.mysql.asyncmysqlrowiterator' =>
        '/hack/reference/class/AsyncMysqlRowIterator/',
      'hack.intro' => '/hack/overview/introduction',
      'hack.arrays' => '/hack/collections/introduction',
      'hack.async' => '/hack/async/introduction',
      'hack.attributes' => '/hack/attributes/introduction',
      'hack.collections.vector' => '/hack/reference/class/Vector/',
      'hack.collections.set' => '/hack/reference/class/Set/',
      'hack.collections.pair' => '/hack/reference/class/Pair/',
      'hack.collections.map' => '/hack/reference/class/Map/',
      'hack.collections.immvector' => '/hack/reference/class/ImmVector/',
      'hack.collections.immset' => '/hack/reference/class/ImmSet/',
      'hack.collections.immmap' => '/hack/reference/class/ImmMap/',
      'hack.collections' => '/hack/collections/introduction',
      'hack.constructorargumentpromotion' =>
        '/hack/other-features/constructor-parameter-promotion',
      'hack.enums' => '/hack/enums/introduction',
      'hack.generics' => '/hack/generics/introduction',
      'modes' => '/hack/typechecker/modes',
      'hack.lambda' => '/hack/lambdas/introduction',
      'hack.methoddispatch' => '/hack/',
      'hack.nullable' => '/hack/types/type-system#nullable',
      'hack.otherrulesandfeatures' => '/hack/other-features/introduction',
      'hack.predefined.interfaces' => '/hack/reference/interface/',
      'hack.shapes' => '/hack/shapes/introduction',
      'hack.traits' => '/hack/other-features/trait-and-interface-requirements',
      'hack.tuples' => '/hack/tuples/introduction',
      'hack.typealiasing' => '/hack/type-aliases/introduction',
      'hack.annotations' => '/hack/types/annotations',
      'hack.unsupported' => '/hack/unsupported/introduction',
      'hack.xhp' => '/hack/XHP/introduction',
      'hackfuncref' => '/hack/reference/',
      'book.hackcollections' => '/hack/collections/introduction',
      'intro.collections' => '/hack/collection/introduction',
      'book.enums' => '/hack/enums/introduction',
      'intro.enums' => '/hack/enums/introduction',
      'ref.enums' => '/hack/enums/functions',
      'function.hack.enums' => '/hack/enums/functions',
      'intro.hackmagic' => '/hack/callables/special-functions',
      'ref.hackmagic' => '/hack/callables/special-functions',
      'function.hack.invariant' => '/hack/types/refining#invariant',
      'function.hack.fun' => '/hack/callables/special-functions',
      'function.hack.class_meth' => '/hack/callables/special-functions',
      'function.hack.inst_meth' => '/hack/callables/special-functions',
      'function.hack.meth_caller' => '/hack/callables/special-functions',
      'book.hack.async.mysql' => '/hack/async/extensions#mysql',
      'intro.hack.async.mysql' => '/hack/async/extensions#mysql',
      'hack.async.mysql.examples' => '/hack/async/extensions#mysql',
      'book.hack.mcrouter' => '/hack/async/extensions#mcrouter',
      'intro.hack.mcrouter' => '/hack/async/extensions#mcrouter',
      'intro.mcrouter' => '/hack/async/extensions#mcrouter',
      'hack.mcrouter.examples' => '/hack/async/extensions#mcrouter',
      'intro.asio' => '/hack/async/utility-functions',
      'hack.ref.asio' => '/hack/async/utility-functions',
      'hack.asio.function' => '/hack/async/utility-functions',
      'ini.list' => '/hhvm/configuration/INI-settings',
      'install.fastcgi' => '/hhvm/advanced-usage/fastCGI',
      'install.linux' => '/hhvm/installation/linux',
      'install.extensions' => '/hhvm/extensions/introduction',
      'install-intro' => '/hhvm/installation/introduction',
      'install-xhp' => '/hack/XHP/introduction#the-xhp-lib-library',
      'install-hack' => '/hack/typechecker/install',
      'install.hack.bootstrapping' => '/hack/getting-started/getting-started',
      'install.hack.conversion' => '/hack/tools/introduction',
      'install.hack' => '/hack/getting-started/getting-started',
      'hack' => '/hack/',
      'configuration.zend.compat' =>
        '/hhvm/configuration/INI-settings#feature-flags',
      'intro-what-can-hhvm-do' => '/hhvm/getting-started/getting-started',
      'docshhvmimprovedsearch' => '/',
    };
  }
}
