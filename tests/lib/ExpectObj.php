<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace HH\Lib\Str;

final class ExpectObj<T> extends \Facebook\FBExpect\ExpectObj<T> {
  public function toMatchExpectFile(string $file): void where T = string {
    $this->toBeSame(
      \file_get_contents($file),
      "Did not match contents of file '%s'",
      $file,
    );
  }

  public function toMatchExpectregexFile(string $file): void where T = string {
    $this->toMatchRegExp(
      \file_get_contents($file),
      "Did not match regex in file '%s'",
      $file,
    );
  }

  public function toMatchExpectfFile(string $file): void where T = string {
    // derived from hphp/test/run.php
    $pattern = \file_get_contents($file)
      |> \preg_quote($$, '/')
      |> Str\replace_every($$, dict[
        // Stick to basics.
        '%e' => '\\'.\DIRECTORY_SEPARATOR,
        '%s' => '[^\r\n]+',
        '%S' => '[^\r\n]*',
        '%a' => '.+',
        '%A' => '.*',
        '%w' => '\s*',
        '%i' => '[+-]?\d+',
        '%d' => '\d+',
        '%x' => '[0-9a-fA-F]+',
        // %f allows two points "-.0.0" but that is the best simple expression.
        '%f' => '[+-]?\.?\d+\.?\d*(?:[Ee][+-]?\d+)?',
        '%c' => '.',
        // must be last.
        '%%' => '%%?',
      ])
      |> '/'.$$.'/';
    $this->toMatchRegExp($pattern, "Did not match pattern in file '%s'", $file);
  }
}
