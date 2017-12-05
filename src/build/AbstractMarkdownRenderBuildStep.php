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
use namespace Facebook\GFM as FBMarkdown;

abstract class AbstractMarkdownRenderBuildStep extends BuildStep {
  abstract const string SOURCE_ROOT;
  abstract const string BUILD_ROOT;

  const string RENDERER = LocalConfig::ROOT.'/md-render/render.rb';
  const int MAX_JOBS = 20;

  protected function renderFiles(Traversable<string> $files): Vector<string> {
    Log::i("\nRendering markdown to HTML");
    $jobs = dict[];

    foreach ($files as $input) {
      $output = self::getOutputFileName($input);
      $jobs[$input] = $output;
    }


    if ((bool) \getenv('FB_GFM')) {
      Log::v(' [fbgfm] ');
      $parser_ctx = (new FBMarkdown\ParserContext())
        ->setBlockContext(
          (new GFM\BlockContext())
            ->prependBlockTypes(
              GFM\YamlFrontMatterBlock::class,
              GFM\ExamplesIncludeBlock::class,
            )
        )
        ->enableHTML_UNSAFE();
      $parser_ctx->getInlineContext()->prependInlineTypes(
        GFM\AutoLinkifyInline::class,
      );
      $render_ctx = (new FBMarkdown\RenderContext())
        ->appendFilters(
          new GFM\HeadingAnchorsFilter(),
          new GFM\VersionedImagesFilter(),
        );

      $files = $jobs;
      foreach ($jobs as $in => $out) {
        $parser_ctx
          ->resetFileData()
          ->setFilePath($in);
        $doc = FBMarkdown\parse($parser_ctx, \file_get_contents($in));
        invariant($doc !== null, 'transform should not null the doc');
        $html = (new FBMarkdown\HTMLRenderer())->render($render_ctx, $doc);
        \file_put_contents($out, '<!-- fbgfm -->'.$html);
        Log::v('.');
      }
    } else {
      Log::v(' [ruby] ');
      $files = $this->renderFilesWithRuby($jobs);
    }

    return new Vector($files);
  }

  protected function renderFilesWithRuby(
    dict<string, string> $files,
  ): vec<string> {
    $ret = vec[];
    $pipes = [];
    $renderer = proc_open(
      self::RENDERER,
      [['pipe', 'r'], ['pipe', 'w']],
      $pipes,
      /* cwd = */ dirname(self::RENDERER),
    );
    list($stdin, $stdout) = $pipes;
    stream_set_blocking($stdout, true);

    $in_progress = 0;
    foreach ($files as $input => $output) {
      if ($in_progress == self::MAX_JOBS) {
        $result = $this->parseSingleRenderResult(trim(fgets($stdout)));
        --$in_progress;
        if ($result !== null) {
          $ret[] = $result;
        }
      }

      ++$in_progress;
      fprintf($stdin, "%s -> %s\n", $input, $output);
      Log::v('+');
    }
    fclose($stdin);

    while ($line = trim(fgets($stdout))) {
      $result = $this->parseSingleRenderResult($line);
      if ($result !== null) {
        $ret[] = $result;
      }
    }

    $exit_code = proc_close($renderer);
    invariant(
      $exit_code === 0,
      'Markdown renderer exited with error code %d!',
      $exit_code,
    );
    return $ret;
  }

  private function parseSingleRenderResult(string $line): ?string {
    if (substr($line, 0, 4) !== 'OK] ') {
      Log::v('!');
      return null;
    }
    Log::v('-');
    list($in, $out) = explode(' -> ', $line);
    // $in still has 'OK] ' prefix, but we don't need it now anyway
    return $out;
  }

  public static function getOutputFileName(string $input): string {
    $input = str_replace(static::SOURCE_ROOT.'/', '', $input);
    $parts = (new Vector(explode('/', $input)))
      ->map(
        $part ==> preg_match('/^[0-9]{2}-/', $part) ? substr($part, 3) : $part
      );

    $output = implode('/', $parts);

    $dir = dirname($output);
    $output =
      static::BUILD_ROOT.'/'.
      ($dir === '.' ? '' : $dir.'/').
      basename($output, '.md').
      '.html';

    $output_dir = dirname($output);
    if (!is_dir($output_dir)) {
      mkdir($output_dir, /* mode = */ 0755, /* recursive = */ true);
    }

    return $output;
  }
}
