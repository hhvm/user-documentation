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

use namespace Facebook\TypeSpec;

final class PHPIniSupportInHHVMMarkdownBuildStep extends BuildStep {
  <<__Override>>
  public function buildAll(): void {
    Log::i("\nPHPIniSupportInHHVMMarkdownBuild");
    $settings = \file_get_contents(BuildPaths::PHP_INI_SUPPORT_IN_HHVM_JSON)
      |> JSON\decode_as_dict($$)
      |> TypeSpec\dict(TypeSpec\string(), TypeSpec\string())->assertType($$);
    if (!\is_dir(BuildPaths::GUIDES_GENERATED_MARKDOWN)) {
      \mkdir(
        BuildPaths::GUIDES_GENERATED_MARKDOWN,
        /* mode = */ 0755,
        /* recursive = */ true,
      );
    }
    $md = $this->getMarkdown($settings);
    \file_put_contents(
      BuildPaths::GUIDES_GENERATED_MARKDOWN.'/php_ini_support_in_hhvm.md',
      $md,
    );
  }

  private function getMarkdown(dict<string, string> $settings): string {
    $md = '';
    $cols = 5;
    // Create blank table headers
    $md .= \str_repeat(' Option |', $cols);
    $md = \rtrim($md, '|');
    $md .= "\n";
    $md .= \str_repeat('------ |', $cols);
    $md = \rtrim($md, '|');
    $md .= "\n";
    // Add settings to table
    $col = 0;
    foreach ($settings as $setting => $url) {
      if ($col === $cols) {
        $md = \rtrim($md, '|');
        $md .= "\n";
        $col = 0;
      }
      $md .= '['.$setting.']('.$url.') |';
      $col++;
    }

    return $md;
  }
}
