<?hh // strict

namespace HHVM\UserDocumentation;

class YAMLWriter {
  public function __construct(
    private string $destination,
  ) {
  }

  public function write(BaseYAML $def): void {
    file_put_contents(
      $this->getFileName($def),
      /* UNSAFE_EXPR: no HHI for Spyc */
      \Spyc::YAMLDump($def),
    );
  }

  private function getFileName(BaseYAML $def): string {
    $prefix = $def['type'];

    $def_name = strtr($def['data']['name'], "\\", '.');

    return sprintf(
      '%s/%s.%s.yml',
      $this->destination,
      $prefix,
      $def_name,
    );
  }
}
