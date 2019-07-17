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

use namespace HH\Lib\{C, Str};
use namespace Facebook\{HackCodegen as CG, TypeAssert};

// Index of all definitions, so that markdown processing can
// automatically linkify them
final class UnifiedAPIIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  <<__Override>>
  public function buildAll(): void {
    Log::i("\nUnifiedAPIIndexBuildStep");
    $cg = $this->getCodegenFactory();

    $defs = Map {};
    $defs->setAll($this->getHackAPILinks(APIProduct::HACK));
    $defs->setAll($this->getHackAPILinks(APIProduct::HSL));
    $defs->setAll($this->getSpecialAttributeLinks());

    $cg->codegenFile(BuildPaths::UNIFIED_INDEX)
      ->setNamespace("HHVM\\UserDocumentation")
      ->addClass(
        $cg->codegenClass('UnifiedIndexData')
          ->setIsFinal(true)
          ->setIsAbstract(true)
          ->addMethod(
            $cg->codegenMethod('getIndex')
              ->setIsStatic(true)
              ->setReturnType('dict<string, string>')
              ->setBody(
                $cg->codegenHackBuilder()
                  ->addReturn(
                    dict($defs),
                    CG\HackBuilderValues::dict(
                      CG\HackBuilderKeys::export(),
                      CG\HackBuilderValues::export(),
                    ),
                  )
                  ->getCode(),
              ),
          ),
      )
      ->save();
    // Make it available to later build steps
    require_once(BuildPaths::UNIFIED_INDEX);


    $jump_index = dict[];
    foreach ($defs as $name => $url) {
      $name = Str\lowercase($name);
      if (
        (!C\contains_key($jump_index, $name)) ||
        Str\length($jump_index[$name]) > Str\length($url)
      ) {
        $jump_index[$name] = $url;
      }
    }

    $cg->codegenFile(BuildPaths::JUMP_INDEX)
      ->setNamespace("HHVM\\UserDocumentation")
      ->addClass(
        $cg->codegenClass('JumpIndexData')
          ->setIsFinal(true)
          ->setIsAbstract(true)
          ->addMethod(
            $cg->codegenMethod('getIndex')
              ->setIsStatic(true)
              ->setReturnType('dict<string, string>')
              ->setBody(
                $cg->codegenHackBuilder()
                  ->addReturn(
                    $jump_index,
                    CG\HackBuilderValues::dict(
                      CG\HackBuilderKeys::export(),
                      CG\HackBuilderValues::export(),
                    ),
                  )
                  ->getCode(),
              ),
          ),
      )
      ->save();
  }

  private function getHackAPILinks(
    APIProduct $product,
  ): ImmMap<string, string> {
    Log::v("\nProcessing %s API Index", $product);

    $out = Map {};
    $maybe_set = ($name, $url) ==> {
      if (
        (!C\contains_key($out, $name)) ||
        Str\length($out[$name]) > Str\length($url)
      ) {
        $out[$name] = $url;
      }
    };

    foreach (APIDefinitionType::getValues() as $type) {
      $defs = APIIndex::get($product)->getIndexForType($type);
      foreach ($defs as $_ => $def) {
        $name = $def['name'];
        $maybe_set($name, $def['urlPath']);

        $ns_pos = \strrpos($name, "\\");
        if ($ns_pos !== false) {
          $name = \substr($name, $ns_pos + 1);
          $maybe_set($name, $def['urlPath']);
        }

        if ($type === APIDefinitionType::FUNCTION_DEF) {
          continue;
        }

        $def = TypeAssert\matches_type_structure(
          type_alias_structure(APIClassIndexEntry::class),
          $def,
        );

        $methods = $def['methods'];

        foreach ($methods as $_ => $method) {
          $name = $method['className'].'::'.$method['name'];
          $maybe_set($name, $method['urlPath']);
        }
      }
    }
    return $out->toImmMap();
  }

  // For special attributes that don't exist in our API reference, but can be
  // used in APIs, manually add special /j/search capability
  private function getSpecialAttributeLinks(): ImmMap<string, string> {
    return ImmMap {
      '__memoize' => '/hack/attributes/special#__memoize',
      '__consistentconstruct' =>
        '/hack/attributes/special#__consistentconstruct',
      '__override' => '/hack/attributes/special#__override',
      '__deprecated' => '/hack/attributes/special#__deprecated',
      '__mockclass' => '/hack/attributes/special#__mockclass',
      '__isfoldable' => '/hack/attributes/special#__isfoldable',
      '__native' => '/hack/attributes/special#__native',
    };
  }
}
