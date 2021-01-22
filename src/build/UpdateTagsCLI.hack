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

use type Facebook\CLILib\CLIBase;
use namespace Facebook\CLILib\CLIOptions;
use namespace HH\Lib\{C, Dict, Str, Vec};
use namespace Facebook\HackCodegen as CG;

final class UpdateTagsCLI extends CLIBase {
  const dict<APIProduct, (string, string)> REPOS_AND_TAG_PREFIXES = dict[
    APIProduct::HACK => tuple('facebook/hhvm', 'HHVM-'),
    APIProduct::HSL => tuple('hhvm/hsl', 'v'),
    APIProduct::HSL_EXPERIMENTAL => tuple('hhvm/hsl-experimental', 'v'),
  ];
  private dict<APIProduct, string> $forcedTags = dict[];

  <<__Override>>
  protected function getSupportedOptions(): vec<CLIOptions\CLIOption> {
    return vec[
      CLIOptions\with_required_string(
        $version ==> {
          $this->forcedTags[APIProduct::HACK] = $version;
        },
        'Use the specified HHVM tag instead of the latest release',
        '--hhvm-tag',
      ),
      CLIOptions\with_required_string(
        $version ==> {
          $this->forcedTags[APIProduct::HSL] = $version;
        },
        'Use the specified HSL version instead of the latest release',
        '--hsl-tag',
      ),
      CLIOptions\with_required_string(
        $version ==> {
          $this->forcedTags[APIProduct::HSL_EXPERIMENTAL] = $version;
        },
        'Use the specified HSL-Experimental version instead of the latest release',
        '--hsl-experimental-tag',
      ),

    ];
  }

  private async function getTagAsync(APIProduct $product): Awaitable<string> {
    $forced = $this->forcedTags[$product] ?? null;
    if ($forced !== null) {
      return $forced;
    }
    list($project, $prefix) = self::REPOS_AND_TAG_PREFIXES[$product];

    $refs = vec[
      'git',
      'ls-remote',
      '--tags',
      'https://github.com/'.$project.'.git',
      '--quiet',
      $prefix.'*'
    ]
      |> Vec\map($$, $arg ==> \escapeshellarg($arg))
      |> Str\join($$, ' ')
      |> Str\trim(\shell_exec($$))
      |> Str\split($$, "\n");
    $tags = keyset[];
    foreach ($refs as $line) {
      $parts = Str\split($line, "\t");
      // $ref = $parts[0];
      $name = $parts[1];
      $tags[] = Str\strip_prefix($name, 'refs/tags/');
    }
    return Vec\sort($tags, ($a, $b) ==> \version_compare($a, $b))
      |> C\lastx($$);
  }

  <<__Override>>
  public async function mainAsync(): Awaitable<int> {
    $new_tags = await Dict\map_with_key_async(
      self::REPOS_AND_TAG_PREFIXES,
      async ($product, $_) ==> await $this->getTagAsync($product),
    );

    $changes = dict[];
    foreach ($new_tags as $product => $new_tag) {
      if ((PRODUCT_TAGS[$product] ?? null) !== $new_tag) {
        $changes[$product] = $new_tag;
      }
    }
    $stdout = $this->getTerminal()->getStdout();

    if (C\is_empty($changes)) {
      await $stdout->writeAllAsync("Nothing to do.\n");
      return 0;
    }
    await $stdout->writeAllAsync(
      Dict\map_with_key(
        $changes,
        ($k, $v) ==> Str\format('%s to tag "%s"', $k, $v),
      )
        |> Str\join($$, ', and ')
        |> 'Changing '.$$."...\n",
    );

    if (C\contains_key($changes, APIProduct::HACK)) {
      await $this->updateHHVMVersionAsync($changes[APIProduct::HACK]);
    }

    $tags_file = LocalConfig::ROOT.'/src/codegen/PRODUCT_TAGS.php';
    await $stdout->writeAllAsync(' - Updating '.$tags_file."\n");
    $config = new CG\HackCodegenConfig();
    $cg = new CG\HackCodegenFactory(
      $config->withFormatter(new CG\HackfmtFormatter($config)),
    );
    $cg->codegenFile($tags_file)
      ->setNamespace("HHVM\\UserDocumentation")
      ->addConstant(
        $cg->codegenConstant('PRODUCT_TAGS')
          ->setType('dict<APIProduct, string>')
          ->setValue(
            $new_tags,
            CG\HackBuilderValues::dict(
              CG\HackBuilderKeys::lambda(
                ($_, $p) ==> 'APIProduct::'.APIProduct::getNames()[$p],
              ),
              CG\HackBuilderValues::export(),
            ),
          ),
      )
      ->save();

    await $stdout->writeAllAsync(
      "Done! Next steps:\n".
      " - update your HHVM installation if needed\n".
      " - php composer.phar update\n".
      " - hhvm bin/build.php\n".
      " - hh_client\n".
      " - hhvm vendor/bin/hacktest tests/\n",
    );
    return 0;
  }

  private async function updateHHVMVersionAsync(
    string $hhvm_tag,
  ): Awaitable<void> {
    $new_major_minor = $hhvm_tag
      |> Str\strip_prefix($$, 'HHVM-')
      |> Str\split($$, '.')
      |> Vec\take($$, 2)
      |> Str\join($$, '.');
    $old_major_minor = PRODUCT_TAGS[APIProduct::HACK]
      |> Str\strip_prefix($$, 'HHVM-')
      |> Str\split($$, '.')
      |> Vec\take($$, 2)
      |> Str\join($$, '.');
    $stdout = $this->getTerminal()->getStdout();

    await $stdout->writeAllAsync(" - updating composer.json\n");
    $this->updateComposerJson($new_major_minor);

    await $stdout->writeAllAsync(" - updating Dockerfiles\n");
    foreach (\glob(LocalConfig::ROOT.'/.deploy/*.Dockerfile') as $path) {
      \file_get_contents($path)
        |> Str\replace(
          $$,
          'hhvm-proxygen:'.$old_major_minor.'-latest',
          'hhvm-proxygen:'.$new_major_minor.'-latest',
        )
        |> Str\replace(
          $$,
          'hhvm:'.$old_major_minor.'-latest',
          'hhvm:'.$new_major_minor.'-latest',
        )
        |> \file_put_contents($path, $$);
    }
    await $stdout->writeAllAsync(" - updating GitHub Actions\n");
    $path = LocalConfig::ROOT.'/.github/workflows/build-and-test.yml';
    \file_get_contents($path)
      |> Str\replace(
        $$,
        "hhvm: [ '".$old_major_minor."' ]",
        "hhvm: [ '".$new_major_minor."' ]",
      )
      |> \file_put_contents($path, $$);
  }

  private function updateComposerJson(string $hhvm_major_minor): void {
    $path = LocalConfig::ROOT.'/composer.json';
    $composer = \json_decode(
      \file_get_contents($path),
      /* assoc = */ true,
      /* depth = */ 512,
      \JSON_FB_HACK_ARRAYS,
    );
    $composer['require']['hhvm'] = $hhvm_major_minor.'.*';
    \file_put_contents(
      $path,
      \json_encode($composer, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES).
      "\n",
    );
  }
}
