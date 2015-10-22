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
    return '## The '.$this->getName().' '.$this->yaml['type']."\n\n";
  }

  private function getContents(): string {
    $prefix = $this->getName().'::';
    $md = "### Interface synopsis\n";
    foreach ($this->yaml['data']['methods'] as $method) {
      $method_url = sprintf(
        "/hack/reference/%s/%s/%s/",
        $this->yaml['type'],
        str_replace('\\', '.', $this->yaml['data']['name']),
        $method['name'],
      );
      $md .= 
        ' * ['.$prefix.self::nameFromData($method).']('. $method_url .")\n";
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
      $name .= '&lt;'.implode(',', $generics).'&gt;';
    }
    return $name;
  }
}
