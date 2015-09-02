<?hh

namespace HHVM\UserDocumentation;

class ClassMarkdownBuilder {
  private ClassYAML $yaml;

  public function __construct(
    string $file,
  ) {
    $this->yaml = \Spyc::YAMLLoad($file);
  }

  public function build(): string {
    $md = $this->getHeading();
    $md .= $this->getContents();
    return $md;
  }

  private function getHeading(): string {
    $heading = 'The '.$this->getName().' '.$this->yaml['type'];
    return $heading."\n".str_repeat('=', strlen($heading))."\n\n";
  }

  private function getContents(): string {
    $prefix = $this->getName().'::';
    $md =
      "Interface synposis\n".
      "------------------\n\n";
    foreach ($this->yaml['data']['methods'] as $method) {
      $md .= ' * '.$prefix.self::nameFromData($method)."\n";
    }
    return $md;
  }

  <<__Memoize>>
  private function getName(): string {
    return self::nameFromData($this->yaml['data']);
  }

  private static function nameFromData(
    shape('name' => string, 'generics' => array<GenericDocumentation>) $data,
  ): string {
    $name = $data['name'];
    $generics = $data['generics'];
    if (count($generics) !== 0) {
      $generics = array_map(
        $generic ==> $generic['name'],
        $generics,
      );
      $name .= '<'.implode(',', $generics).'>';
    }
    return $name;
  }
}
