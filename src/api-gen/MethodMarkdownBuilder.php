<?hh // strict

namespace HHVM\UserDocumentation;

class MethodMarkdownBuilder {
  private ClassYAML $yaml;
  
  public function __construct(
    private string $file,
  ) {
    $this->yaml = \Spyc::YAMLLoad($file);
  }

  public function build(): void {
    $classname = $this->yaml['data']['name'];
    foreach ($this->yaml['data']['methods'] as $method) {
      $this->buildOne($method);
    }
  }

  private function buildOne(
    FunctionDocumentation $method,
  ): void {
    $classname = $this->yaml['data']['name'];
    $md = (new FunctionMarkdownBuilder($this->file, $method, $classname))
      ->getMarkdown();

    $filename = self::getOutputFileName(
      APIDefinitionType::assert($this->yaml['type']),
      $this->yaml['data'],
      $method,
    );

    file_put_contents($filename, $md);
  }

  public static function getOutputFileName(
    APIDefinitionType $class_type,
    ClassDocumentation $class,
    FunctionDocumentation $method,
  ): string {
    $class_file_name = ClassMarkdownBuilder::getOutputFileName(
      $class_type,
      $class
    );
    return str_replace(
      '.md',
      sprintf('.method.%s.md', $method['name']),
      $class_file_name,
    );
  }
}
