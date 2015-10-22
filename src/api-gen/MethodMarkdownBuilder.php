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
    foreach ($this->yaml['data']['methods'] as $method) {
      $filename = pathinfo($this->classfile)['filename'];
      $type = explode('.', $filename)[0];
      $output_path = 
        BuildPaths::MERGED_MD.'/'.$filename.'.method.'.$method['name'].'.md';
      file_put_contents($output_path, $this->build($method));
    }
  }

  private function build(FunctionDocumentation $method): string {
    $md = new FunctionMarkdownBuilder($this->classfile, $method);
    return $md->build();
  }
}