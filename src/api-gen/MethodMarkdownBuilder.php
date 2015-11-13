<?hh

namespace HHVM\UserDocumentation;

class MethodMarkdownBuilder {
  private ClassYAML $yaml;
  private string $classfile;
  
  public function __construct(
    string $file,
  ) {
    $this->classfile = $file;
    $this->yaml = \Spyc::YAMLLoad($file);
  }

  public function buildAll(): void {
    $classname = $this->yaml['data']['name'];
    foreach ($this->yaml['data']['methods'] as $method) {
      $filename = pathinfo($this->classfile)['filename'];
      $type = explode('.', $filename)[0];
      $output_path = 
        BuildPaths::APIDOCS_MARKDOWN.'/'.$filename.'.method.'.$method['name'].'.md';
      file_put_contents(
        $output_path,
        $this->build($classname, $method),
      );
    }
  }

  private function build(
    string $classname,
    FunctionDocumentation $method,
  ): string {
    $md = new FunctionMarkdownBuilder($this->classfile, $method, $classname);
    return $md->build();
  }
}
