<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace HH\Lib\{C, Str};
use type Facebook\HackTest\ExpectationFailedException;

final class ExpectObj<T> extends \Facebook\FBExpect\ExpectObj<T> {
  public function __construct(private T $var) {
    parent::__construct($var);
  }

  public function toMatchExpectFile(string $file): void where T = string {
    $this->toMatchFileWrapper(
      () ==> {
        expect(\file_get_contents($this->var))->toEqual(
          \file_get_contents($file),
        );
      },
      $file,
    );
  }

  public function toMatchExpectregexFile(string $file): void where T = string {
    $this->toMatchFileWrapper(
      () ==> {
        expect(\file_get_contents($this->var))->toMatchRegExp(
          '/^'.\file_get_contents($file).'$/s',
        );
      },
      $file,
    );
  }

  public function toMatchExpectfFile(string $file): void where T = string {
    // derived from hphp/test/run.php
    $pattern = \file_get_contents($file)
      |> Str\trim($$)
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
    $this->toMatchFileWrapper(
      () ==> {
        expect(\file_get_contents($this->var))->toMatchRegExp($pattern);
      },
      $file,
    );
  }

  private function toMatchFileWrapper(
    (function(): void) $impl,
    string $expected_path,
  ): void where T = string {
    $actual_path = $this->var;
    try {
      $impl();
    } catch (ExpectationFailedException $_) {
      $extension = C\lastx(Str\split($expected_path, '.'));
      throw new ExpectationFailedException(Str\format(
        "Actual data did not match expected data\n".
        "----- ACTUAL  ----\n  Path: %s\n--\n%s\n".
        "----- %s ----\n  Path: %s\n--\n%s\n----- END -----",
        $actual_path,
        \file_get_contents($actual_path),
        Str\uppercase($extension),
        $expected_path,
        \file_get_contents($expected_path),
      ));
    }
  }
}
