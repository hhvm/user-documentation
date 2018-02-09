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

use type Facebook\HHAPIDoc\DocBlock\DocBlock;
use namespace HH\Lib\{C, Str, Vec};

final class FunctionMarkdownBuilder {
  private FunctionYAML $yaml;
  private DocBlock $docblock;
  private ?string $class = null;

  public function __construct(
    private APIProduct $product,
    string $file,
    ?(string, FunctionDocumentation) $method_data = null,
  ) {
    if ($method_data === null) {
      $this->yaml = JSON\decode_as_shape(
        FunctionYAML::class,
        \file_get_contents($file),
      );
    } else {
      $root = JSON\decode_as_shape(
        ClassYAML::class,
        \file_get_contents($file),
      );
      list($class, $method) = $method_data;
      $this->class = $class;
      $this->yaml = shape(
        'sources' => $root['sources'],
        'type' => $root['type'],
        'data' => $method,
      );
    }

    $comment = $this->yaml['data']['docComment'];
    $this->docblock = new DocBlock($comment ?? '');
  }

  public function build(): string {
    $md = $this->getMarkdown();
    $filename = self::getOutputFileName($this->product, $this->yaml['data']);
    \file_put_contents($filename, $md);
    return $filename;
  }

  public function getMarkdown(): string {
    $parts = vec[
      $this->getFrontMatterString(),
      $this->getHeading(),
      $this->getDeprecation(),
      $this->getDescription(),
      $this->getParameters(),
      $this->getReturnValues(),
      $this->getExamples(),
    ];

    $main_md = $parts
      |> Vec\filter_nulls($$)
      |> Vec\filter($$, $x ==> !Str\is_empty($x))
      |> Str\join($$, "\n\n");
    return $main_md."\n";
  }

  private function getFrontMatterString(): string {
    $data = $this->getFrontMatterData();
    $json = JSON\encode_shape(
      YAMLMeta::class,
      $data,
    );
    return "```yamlmeta\n".$json."\n```";
  }

  private function getFrontMatterData(): YAMLMeta {
    $data = shape(
      'name' => $this->yaml['data']['name'],
      'sources' => Vec\map(
        $this->yaml['sources'],
        $source ==> Str\strip_prefix($source['name'], LocalConfig::ROOT.'/'),
      ),
    );
    $class = $this->class;
    if ($class !== null) {
      $data['class'] = $class;
    }

    $fbonly_messages = vec[];
    if (
      C\any($data['sources'], $s ==> Str\starts_with($s, 'api-sources/hsl/'))
    ) {
      $data['lib'] = shape(
        'name' => 'the Hack Standard Library',
        'github' => 'hhvm/hsl',
        'composer' => 'hhvm/hsl',
      );
    }
    if (
      !C\any($data['sources'], $s ==> Str\starts_with($s, 'api-sources/hhvm/'))
    ) {
      $name = Str\strip_prefix($data['name'], "HH\\Lib\\");
      if (Str\ends_with($name, '_async')) {
        $parts = Str\split($name, '\\');
        $last = C\lastx($parts);
        $parts = Vec\take($parts, C\count($parts) - 1);

        if ($last === 'from_async') {
          $parts[] = 'gen';
        } else {
          $parts[] = 'gen_'.Str\strip_suffix($last, '_async');
        }
        $name = Str\join($parts, "\\");
      }
      $fbonly_messages[] = "This function is available as `".$name."()` in ".
        "Facebook's www repository.";
    }
    if (!C\is_empty($fbonly_messages)) {
      $data['fbonly messages'] = $fbonly_messages;
    }

    return $data;
  }

  public static function getOutputFileName(
    APIProduct $product,
    FunctionDocumentation $docs,
  ): string {
    return \sprintf(
      '%s/%s/function.%s.md',
      BuildPaths::APIDOCS_MARKDOWN,
      $product,
      \strtr($docs['name'], "\\", '.'),
    );
  }

  private function getHeading(): ?string {
    return $this->docblock->getSummary();
  }

  private function getDeprecation(): ?string {
    $message = $this->yaml['data']['deprecation'];
    if ($message !== null) {
      return "### Deprecation\n\n" . $message . "\n\n";
    }
    return null;
  }

  private function getDescription(): string {
    $md = "### Description\n\n";

    $md .=
      "```HackSignature\n<?hh\n".
      Stringify::signature($this->yaml['data']).
      "\n```\n\n";

    $md .= $this->docblock->getDescription();

    return $md;
  }

  private function getParameters(): ?string {
    // If no parameters for the function, then move on
    if (\count($this->yaml['data']['parameters']) === 0) {
      return null;
    }

    $tags = $this->docblock->getParameterInfo();

    $md = "### Parameters\n\n";

    foreach ($this->yaml['data']['parameters'] as $param) {
      $name = $param['name'];

      // The keys in the $tags map are actually the parameter names with the
      // $. Why? I don't know.
      $tag = idx($tags, '$'.$name);

      $md .= '- `'.Stringify::parameter($param, $tag).'`';
      if ($tag) {
        // The '-' is generally included in the description. We can do something
        // more fancy if we need to, like `: ` and a preg_match on the first
        // position of a alphnumeric character, thus getting rid of any '-'
        $md .= ' '.$tag['text'];
      }
      $md .= "\n";
    }
    return $md;
  }

  private function getReturnValues(): ?string {
    $tags = $this->docblock->getReturnInfo();
    if ($tags === null || C\is_empty($tags)) {
      return null;
    }

    $ret = "### Return Values\n";
    foreach ($tags as $tag) {
      $ret .= "\n - ";
      $types = $tag['types'];

      $types = Vec\filter($types, $type ==> $type !== '\-' && $type !== '-');
      if ($types) {
        $ret .= '`'.\implode('|', $types).'` - ';
      } else {
        $ret_th = $this->yaml['data']['returnType'];
        if ($ret_th !== null) {
          $ret .= '`'.Stringify::typehint($ret_th).'` - ';
        }
      }

      $ret .= $tag['text'];
    }
    return $ret;
  }

  private function getExamples(): ?string {
    $path = LocalConfig::ROOT.'/api-examples/';

    if ($this->class === null) {
      $path .= 'function.';
    } else {
      $path .= 'class.'.$this->class.'/';
    }

    $path .= $this->yaml['data']['name'];
    $path = \strtr($path, "\\", '.');
    $examples = (new Vector(\glob($path.'/*.php')))
      ->addAll(\glob($path.'/*.md'))
      ->map($filename ==> \pathinfo($filename, \PATHINFO_FILENAME))
      ->toSet()
      ->toVector(); // Work around issue that Sets can't be sorted

    if (\count($examples) === 0) {
      return null;
    }
    \sort(&$examples);

    $ret = "### Examples\n";
    foreach ($examples as $example) {
      $preamble = $path.'/'.$example.'.md';
      $code = $path.'/'.$example.'.php';
      if (\file_exists($preamble)) {
        $ret .= "\n\n".\file_get_contents($preamble);
      }
      if (\file_exists($code)) {
        $ret .= "\n\n@@ ".$code." @@";
      }
      $ret .= "\n\n";
    }
    return $ret;
  }
}
