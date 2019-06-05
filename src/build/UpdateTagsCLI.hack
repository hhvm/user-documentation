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
use namespace HH\Lib\{C, Dict, Str, Tuple, Vec};
use namespace Facebook\HackCodegen as CG;

final class UpdateTagsCLI extends CLIBase {
  private ?string $forcedHHVMTag;
  private ?string $forcedHSLTag;

  <<__Override>>
  protected function getSupportedOptions(): vec<CLIOptions\CLIOption> {
    return vec[
      CLIOptions\with_required_string(
        $version ==> {
          $this->forcedHHVMTag = $version;
        },
        'Use the specified HHVM tag instead of the latest release',
        '--hhvm-tag',
      ),
      CLIOptions\with_required_string(
        $version ==> {
          $this->forcedHSLTag = $version;
        },
        'Use the specified HSL version instead of the latest release',
        '--hsl-tag',
      ),
    ];
  }

  private async function getLatestTagAsync(
    string $project,
    string $prefix,
  ): Awaitable<string> {
    $url = Str\format('https://api.github.com/repos/%s/tags', $project);

    $req = \curl_init($url);
    \curl_setopt($req, \CURLOPT_USERAGENT, "docs.hhvm.com update-versions.h");

    $json = await \HH\Asio\curl_exec($req);
    return \json_decode(
      $json, /* assoc = */
      true, /* depth = */
      512,
      \JSON_FB_HACK_ARRAYS,
    )
      |> Vec\map($$, $tag ==> $tag['name'] as string)
      |> Vec\filter($$, $tag ==> Str\starts_with($tag, $prefix))
      |> Vec\sort($$, ($a, $b) ==> \version_compare($a, $b))
      |> C\lastx($$);
  }

  private async function getHHVMTagAsync(): Awaitable<string> {
    $v = $this->forcedHHVMTag;
    if ($v !== null) {
      return $v;
    }

    return await $this->getLatestTagAsync('facebook/hhvm', 'HHVM-');
  }

  private async function getHSLTagAsync(): Awaitable<string> {
    $v = $this->forcedHSLTag;
    if ($v !== null) {
      return $v;
    }

    return await $this->getLatestTagAsync('hhvm/hsl', 'v');
  }

  <<__Override>>
  public async function mainAsync(): Awaitable<int> {
    list($hhvm_tag, $hsl_tag) = await Tuple\from_async(
      $this->getHHVMTagAsync(),
      $this->getHSLTagAsync(),
    );
    $changes = dict[];
    if (PRODUCT_TAGS[APIProduct::HACK] !== $hhvm_tag) {
      $changes[APIProduct::HACK] = $hhvm_tag;
    }
    if (PRODUCT_TAGS[APIProduct::HSL] !== $hsl_tag) {
      $changes[APIProduct::HSL] = $hsl_tag;
    }
    $stdout = $this->getTerminal()->getStdout();

    if (C\is_empty($changes)) {
      await $stdout->writeAsync("Nothing to do.\n");
      return 0;
    }
    await $stdout->writeAsync(
      Dict\map_with_key(
        $changes,
        ($k, $v) ==> Str\format('%s to tag "%s"', $k, $v),
      )
        |> Str\join($$, ', and ')
        |> 'Changing '.$$."...\n",
    );

    if (C\contains_key($changes, APIProduct::HACK)) {
      await $this->updateHHVMVersionAsync($hhvm_tag);
    }

    $tags_file = LocalConfig::ROOT.'/src/codegen/PRODUCT_TAGS.php';
    await $stdout->writeAsync(' - Updating '.$tags_file."\n");
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
            dict[
              APIProduct::HACK =>
                $changes[APIProduct::HACK] ?? PRODUCT_TAGS[APIProduct::HACK],
              APIProduct::HSL =>
                $changes[APIProduct::HSL] ?? PRODUCT_TAGS[APIProduct::HSL],
            ],
            CG\HackBuilderValues::dict(
              CG\HackBuilderKeys::lambda(
                ($_, $p) ==> 'APIProduct::'.APIProduct::getNames()[$p],
              ),
              CG\HackBuilderValues::export(),
            ),
          ),
      )
      ->save();

    await $stdout->writeAsync(
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

    await $stdout->writeAsync(" - updating composer.json\n");
    $this->updateComposerJson($new_major_minor);

    await $stdout->writeAsync(" - updating Dockerfile\n");
    $path = LocalConfig::ROOT.'/Dockerfile';
    \file_get_contents($path)
      |> Str\replace(
        $$,
        'hhvm-proxygen:'.$old_major_minor.'-latest',
        'hhvm-proxygen:'.$new_major_minor.'-latest',
      )
      |> \file_put_contents($path, $$);
    await $stdout->writeAsync(" - updating .travis.yml\n");
    $path = LocalConfig::ROOT.'/.travis.yml';
    \file_get_contents($path)
      |> Str\replace(
        $$,
        'HHVM_VERSION='.$old_major_minor.'-latest',
        'HHVM_VERSION='.$new_major_minor.'-latest',
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
      \json_encode($composer, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_SLASHES),
    );
  }
}
