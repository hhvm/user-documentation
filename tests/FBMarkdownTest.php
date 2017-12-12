<?hh // strict

namespace Facebook\Markdown;

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Str, Vec};

use function Facebook\FBExpect\expect;

class FBMarkdownTest extends \PHPUnit_Framework_TestCase {
  const string TAB_REPLACEMENT = "\u{2192}";
  public function getExamples(): array<(string, string)> {
    $spec_file_path = \getenv('GFM_SPEC_FILE');
    if (!is_string($spec_file_path)) {
      $this->markTestSkipped('need GFM_SPEC_FILE env var');
    }
    $parser_ctx = (new ParserContext())->enableHTML_UNSAFE();
    $doc = parse($parser_ctx, \file_get_contents($spec_file_path));

    return $doc->getChildren()
      |> Vec\filter(
        $$,
        $child ==> $child instanceof Blocks\CodeBlock
        && Str\trim((string) $child->getInfoString()) === 'example'
      )
      |> Vec\map(
        $$,
        $child ==>
          TypeAssert\instance_of(Blocks\CodeBlock::class, $child)->getCode(),
      )
      |> Vec\map(
        $$,
        $example ==> Str\replace($example, self::TAB_REPLACEMENT, "\t"),
      )
      |> Vec\map_with_key(
        $$,
        ($i, $example) ==> {
          $parts = Str\split($example, "\n.\n");
          $count = C\count($parts);
          invariant(
            $count === 1 || $count === 2,
            "examples should have input and output, example %d has %d parts",
            $i + 1,
            $count,
          );
          if ($count === 1) {
            $expected = '';
          } else {
            $expected = $parts[1]."\n";
          }
          return tuple($parts[0], $expected);
        }
      )
      |> /* HH_IGNORE_ERROR[4007] */ (array) $$;
  }

  /** @dataProvider getExamples */
  public function testExample(
    string $in,
    string $expected_html,
  ): void {
    $parser_ctx = (new ParserContext())->enableHTML_UNSAFE();
    $ast = parse($parser_ctx, $in);
    $render_ctx = new RenderContext();
    $actual_html = (new HTMLRenderer($render_ctx))->render($ast);

    // Improve output readability
    $actual_html = Str\replace($actual_html, "\t", self::TAB_REPLACEMENT);
    $expected_html = Str\replace($expected_html, "\t", self::TAB_REPLACEMENT);

    expect($actual_html)->toBeSame(
      $expected_html,
      "HTML differs for markdown:\n%s",
      $in,
    );
  }
}
