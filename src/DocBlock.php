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

use namespace HH\Lib\{C, Math, Str, Vec};

final class DocBlock {
  private ?string $summary;
  private ?string $description;

  private vec<(string, ?string)> $tags = vec[];

  public function __construct(string $content) {
    $lines = $content
      |> Str\trim($$)
      |> Str\strip_prefix($$, '/**')
      |> Str\strip_suffix($$, '*/')
      |> Str\trim($$)
      |> Str\split($$, "\n")
      |> Vec\map($$, $l ==> Str\trim_left($l));

    $content_lines = vec[];
    $finished_content = false;
    $at_lines = vec[];

    foreach ($lines as $line) {
      if (Str\starts_with($line, '* ')) {
        $line = Str\strip_prefix($line, '* ');
      } else {
        $line = Str\strip_prefix($line, '*');
     }

      if (Str\starts_with($line, '@')) {
        $finished_content = true;
      }

      if ($finished_content) {
        $at_lines[] = $line;
        continue;
      } else {
        $content_lines[] = $line;
        continue;
      }
    }

    $content = Str\trim_left(Str\join($content_lines, "\n"));

    $first_period = Str\search($content, '.');
    if ($first_period !== null) {
      // Handle '...'
      $slice = Str\slice($content, $first_period);
      $x = Str\trim_left($slice, '.');
      $diff = Str\length($slice) - Str\length($x);
      if ($diff > 2) {
        $first_period = Str\search($content, '.', $first_period + $diff);
      }
    }

    $first_newline = Str\search($content, "\n");
    if ($first_period === null && $first_newline !== null) {
      $sep = $first_newline;
    } else if ($first_period !== null && $first_newline === null) {
      $sep = $first_period;
    } else if ($first_period !== null && $first_newline !== null) {
      $sep = Math\minva($first_newline, $first_period);
    } else {
      $sep = null;
    }

    if ($sep === null && $content !== '') {
      $this->summary = $content;
    } else if ($sep !== null) {
      $this->summary = Str\trim(Str\slice($content, 0, $sep));
      $description = Str\trim(Str\slice($content, $sep + 1));
      if ($description !== '') {
        $this->description = $description;
      }
    }

    $current_tag = null;
    $tags = vec[];

    foreach ($at_lines as $line) {
      $line = Str\trim($line);
      if (Str\starts_with($line, '@')) {
        if ($current_tag !== null) {
          $tags[] = $current_tag;
        }
        $current_tag = $line;
      } else {
        $current_tag .= "\n".$line;
      }
    }
    if ($current_tag !== null) {
      $tags[] = $current_tag;
    }

    foreach ($tags as $tag) {
      $space = Str\search($tag, ' ');
      if ($space === null) {
        $this->tags[] = tuple($tag, null);
        continue;
      }
      $key = Str\slice($tag, 0, $space);
      $value = Str\trim(Str\slice($tag, $space + 1));
      $this->tags[] = tuple($key, $value);
    }
  }

  public function getSummary(): ?string {
    return $this->summary;
  }

  public function getDescription(): ?string {
    return $this->description;
  }

  public function getTagsByName(string $name): vec<string> {
    return $this->tags
      |> Vec\filter(
        $$,
        $tag ==> {
          list($key, $value) = $tag;
          if ($key !== $name) {
            return false;
          }
          if ($value === null) {
            return false;
          }
          return true;
        }
      )
    |> Vec\map($$, $x ==> $x[1])
    |> Vec\filter_nulls($$);
  }

  const type TReturnInfo = shape(
    'types' => vec<string>,
    'text' => ?string,
  );

  public function getReturnInfo(): vec<self::TReturnInfo> {
    $out = vec[];
    foreach ($this->tags as list($key, $value)) {
      if ($key !== '@return' && $key !== '@returns') {
        continue;
      }
      if ($value === null) {
        continue;
      }

      $space = Str\search($value, ' ');
      if ($space === null) {
        $out[] = shape('type' => $value, 'text' => null);
        continue;
      }

      $text = Str\trim(Str\slice($value, $space));
      if ($text === '') {
        $text = null;
      }
      $out[] = shape(
        'type' => Str\slice($value, 0, $space),
        'text' => $text,
      );
    }
    return Vec\map(
      $out,
      $x ==> shape(
        'text' => $x['text'],
        'types' => self::typeToTypes($x['type']),
      ),
    );
  }

  protected static function typeToTypes(?string $type): vec<string> {
    if ($type === null) {
      return vec[];
    }
    return $type
      |> Str\strip_prefix($$, '[')
      |> Str\strip_suffix($$, ']')
      |> Str\split($$, '|')
      |> Vec\map($$, $x ==> Str\trim($x));
  }

  const type TParamInfo = shape(
    'name' => string,
    'types' => vec<string>,
    'text' => ?string,
  );

  <<__Memoize>>
  public function getParamInfo(): dict<string, self::TParamInfo> {
    $out = dict[];
    foreach ($this->tags as list($key, $value)) {
      if ($key !== '@param') {
        continue;
      }
      if ($value === null) {
        continue;
      }
      $name = null;

      $dollar = Str\search($value, '$');
      if ($dollar === null) {
        continue;
      }

      $space = Str\search($value, ' ');

      if ($space === null) {
        $type = null;
        $space = Str\length($value);
      } else if ($space > $dollar) {
        $type = null;
      } else {
        $type = Str\trim(Str\slice($value, 0, $dollar - 1));
        if ($type === '') {
          $type = null;
        }
      }

      $space = Str\search($value, ' ', $dollar);
      if ($space === null) {
        $name = Str\slice($value, $dollar);
        $text = null;
      } else {
        $name = Str\slice($value, $dollar, $space - $dollar);
        $text = Str\trim(Str\slice($value, $space));
      }
      $out[$name] = shape(
        'name' => $name,
        'types' => self::typeToTypes($type),
        'text' => $text,
      );
    }
    return $out;
  }
}
