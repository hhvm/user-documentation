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

use namespace HH\Lib\{C, Str, Vec};
use namespace Facebook\TypeAssert;

final class MergedYAMLBuilder {
  private dict<string, BaseYAML> $definitions = dict[];
  public function __construct(
    private string $destination,
  ) {
  }

  private static function GetMergeKey(
    APIDefinitionType $type,
    string $name,
  ): string {
    if (
      $type === APIDefinitionType::INTERFACE_DEF
      || $type === APIDefinitionType::TRAIT_DEF
    ) {
      $type === APIDefinitionType::CLASS_DEF;
    }

    if (Str\starts_with($name, "HH\\Lib")) {
      return $type.' '.$name;
    }

    $last_ns = strrpos($name, "\\");
    if ($last_ns !== false) {
      $name = substr($name, $last_ns + 1);
    }

    return $type.' '.$name;
  }

  public function build(): void {
    $writer = new YAMLWriter($this->destination);
    foreach ($this->definitions as $def) {
      if ($def['type'] === APIDefinitionType::FUNCTION_DEF) {
        $writer->write(FunctionYAML::class, $def);
        continue;
      }
      $def = TypeAssert\matches_type_structure(
        type_alias_structure(ClassYAML::class),
        $def,
      );
      $methods = $this->removePrivateMethods($def['data']['methods']);
      foreach ($methods as $k => $method) {
        $method['className'] = $def['data']['name'];
        $methods[$k] = $method;
      }
      $methods = Vec\sort_by($methods, $m ==> $m['name']);

      $def['data']['methods'] = vec_like_array_cast($methods);
      $writer->write(ClassYAML::class, $def);
    }
  }

  private function removePrivateMethods<
    T as shape('visibility' => MemberVisibility, ...)
  >(array<T> $methods): vec<T> {
    // We filter out private methods at this late stage as occassionally we have
    // inconsistent ideas of what the visibility is and we want to go for the
    // most restrictive - if we filter out before merge, we'll end up with public
    // or protected, but if it says private anywhere we want to ignore those and
    // just not document the method
    return Vec\filter(
      $methods,
      $method ==> $method['visibility'] !== 'private',
    );
  }

  public function addDefinition(BaseYAML $def): this {
    $key = self::GetMergeKey($def['type'], $def['data']['name']);
    if (!C\contains_key($this->definitions, $key)) {
      $this->definitions[$key] = $def;
      return $this;
    }

    $merged = $this->definitions[$key];
    foreach ($def['sources'] as $source) { $merged['sources'][] = $source; }

    // eg SystemLib defines HH\Traversable, HHI defines \Traversable
    if (strpos($def['data']['name'], "\\") !== false) {
      $merged['data']['name'] = $def['data']['name'];
    }

    $merged_data = StringKeyedShapes::toMap($merged['data']);
    $new_data = StringKeyedShapes::toMap($def['data']);

    $merged['data'] = (new MergedDataBuilder($merged_data))
      ->addData($new_data)
      ->build()->toArray();

    // UNSAFE array to shape conversion
    $this->definitions[$key] = $merged;
    return $this;
  }
}
