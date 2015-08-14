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
    $data = $def['data'];
    /* 'Shapes' class not usable in namespaces... */
    /* HH_FIXME[2049] *//* HH_FIXME[4026]*/
    $arr = Shapes::toArray($def);

    $def_name = strtr($data['name'], "\\", '.');
    if ($generics = idx($arr, 'generics')) {
      $def_name .= '.'.implode(
        '',
        array_map($generic ==> $generic['name'], $generics),
      );
    }

    return sprintf(
      '%s/%s.%s.yml',
      $this->destination,
      $prefix,
      $def_name,
    );
  }
}
