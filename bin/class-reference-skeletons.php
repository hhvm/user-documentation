<?hh // strict

/**
 * Usage: hhvm class-reference-skeletons.php SomeClassName
 *
 * Use this script to create skeleton API reference examples
 * for every method in class SomeClassName.
 */

namespace HHVM\UserDocumentation;

require __DIR__.'/../vendor/autoload.php';

const string EXAMPLES_DIRECTORY = __DIR__.'/../guides/hack/99-api-examples';

/* HH_FIXME[1002] This is a script that has toplevel statements */
classReferenceSkeletons($argc, $argv);

function classReferenceSkeletons(int $argc, array<int, string> $argv): void {
  if ($argc < 2) {
    die(sprintf("Usage: %s SomeClassName \n", basename($argv[0])));
  }

  if (!file_exists(EXAMPLES_DIRECTORY)) {
    die(sprintf("Examples directory %s not found \n", EXAMPLES_DIRECTORY));
  }

  $class_name = $argv[1];

  $api_index = APIIndex::getIndex();
  $class_entry = idx($api_index['class'], $class_name);

  if ($class_entry === null) {
    die(sprintf("Class not found in API Index: %s \n", $class_name));
  }

  $class_dir = sprintf('%s/class.%s', EXAMPLES_DIRECTORY, $class_name);
  if (file_exists($class_dir)) {
    echo "Skipping creating class folder (already exists). \n";
  } else {
    printf("%s: Creating class folder. \n", $class_name);
    mkdir($class_dir);
  }

  foreach ($class_entry['methods'] as $method_entry) {
    $method_dir = sprintf('%s/%s', $class_dir, $method_entry['name']);

    if (count(glob($method_dir.'*')) > 0) {
      printf(
        "Skipping method %s (folder already contains files). \n",
        $method_entry['name'],
      );
      continue;
    }

    if (file_exists($method_dir)) {
      printf(
        '%s: Skipping creating folder (already exists). ',
        $method_entry['name'],
      );
    } else {
      printf('%s: Creating folder. ', $method_entry['name']);
      mkdir($method_dir);
    }

    echo 'Writing skeleton files.';
    (new AutogenClassMethod($class_name, $method_entry['name'], $method_dir))
      ->generate();

    echo "\n";
  }
}

final class AutogenClassMethod {
  const string EXAMPLE_NAME = '001-basic-usage';

  public function __construct(
    private string $className,
    private string $methodName,
    private string $directory,
  ) {
    $this->directory = rtrim(
      $directory,
      DIRECTORY_SEPARATOR,
    );
  }

  public function generate(): this {
    return $this->touchFile('.php.hhconfig')
      ->writeFile('.php.hhvm.expect', 'TODO: Replace with expected output')
      ->writeFile('.php.typechecker.expect', 'No errors!')
      ->writeFile('.md', 'TODO: Add preamble content')
      ->writeCodeFile();
  }

  private function writeCodeFile(): this {
    $code = implode(
      "\n",
      Vector {
        '<?hh',
        '',
        sprintf(
          'namespace Hack\UserDocumentation\API\Examples\%s\%s;',
          $this->className,
          ucfirst($this->methodName),
        ),
        '',
        '// TODO: Add example code',
        '',
      },
    );
    return $this->writeFile('.php', $code);
  }

  private function writeFile(string $extension, string $content): this {
    file_put_contents($this->getAbsolutePath($extension), $content);
    return $this;
  }

  private function touchFile(string $extension): this {
    touch($this->getAbsolutePath($extension));
    return $this;
  }

  private function getAbsolutePath(string $extension): string {
    return $this->directory.DIRECTORY_SEPARATOR.self::EXAMPLE_NAME.$extension;
  }
}
