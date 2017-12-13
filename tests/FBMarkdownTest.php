<?hh // strict

namespace Facebook\Markdown;

use namespace Facebook\TypeAssert;
use namespace HH\Lib\{C, Str, Vec};

use function Facebook\FBExpect\expect;

class FBMarkdownTest extends \PHPUnit_Framework_TestCase {
  const string EXAMPLE_START = "\n```````````````````````````````` example";
  const string EXAMPLE_END = "\n````````````````````````````````";
  const string TAB_REPLACEMENT = "\u{2192}";
  // Sanity check - make sure it matches the last one in the spec
  const int EXAMPLE_COUNT = 649;

  public function getExamples(): array<(string, string, string)> {
    $spec_file_path = \getenv('GFM_SPEC_FILE');
    if (!is_string($spec_file_path)) {
      $this->markTestSkipped('need GFM_SPEC_FILE env var');
    }

    $text = \file_get_contents($spec_file_path);
    $raw_examples = vec[];
    $offset = 0;
    while (true) {
      $start = Str\search($text, self::EXAMPLE_START, $offset);
      if ($start === null) {
        break;
      }
      $start += Str\length(self::EXAMPLE_START);
      $start = Str\search($text, "\n", $start);
      invariant($start !== null, "No newline after start marker");
      $end = Str\search($text, self::EXAMPLE_END, $start);
      invariant($end !== null, 'Found start without end at %d', $offset);

      $raw_examples[] = Str\slice(
        $text,
        $start + 1,
        ($end - $start),
      );
      $offset = $end + Str\length(self::EXAMPLE_END);
    }

    $examples = [];

    foreach ($raw_examples as $example) {
      $parts = Str\split($example, "\n.\n");
      $count = C\count($parts);
      invariant(
        $count === 1 || $count === 2,
        "examples should have input and output, example %d has %d parts",
        C\count($examples) + 1,
        $count,
      );
      $examples[] = tuple(
        'Example '.(C\count($examples) + 1),
        Str\replace($parts[0], self::TAB_REPLACEMENT, "\t"),
        $parts[1] ?? '',
      );
    }
    expect(C\count($examples))->toBeSame(
      self::EXAMPLE_COUNT,
      "Did not get the expected number of examples",
    );
    return $examples;
  }

  const dict<string, string> BLACKLIST = dict[
    'Example 312' => 'Out of date named entity table',
  ];

  /** @dataProvider getExamples */
  public function testExample(
    string $name,
    string $in,
    string $expected_html,
  ): void {
    $blacklist = self::BLACKLIST[$name] ?? null;
    if ($blacklist !== null) {
      $this->markTestSkipped($blacklist);
    }

    $parser_ctx = (new ParserContext())->enableHTML_UNSAFE();
    $ast = parse($parser_ctx, $in);
    $render_ctx = new RenderContext();
    $actual_html = (new HTMLRenderer($render_ctx))->render($ast);

    // Improve output readability
    $actual_html = Str\replace($actual_html, "\t", self::TAB_REPLACEMENT);
    $expected_html = Str\replace($expected_html, "\t", self::TAB_REPLACEMENT);

    expect($actual_html)->toBeSame(
      $expected_html,
      "HTML differs for %s:\n%s",
      $name,
      $in,
    );
  }
}
