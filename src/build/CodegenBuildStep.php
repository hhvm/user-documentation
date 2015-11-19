<?hh // strict

namespace HHVM\UserDocumentation;

trait CodegenBuildStep {
  protected function writeCode(
    string $hhi_filename,
    mixed $return_value,
  ): string {
    /* TODO: Use hack-codegen once
     * https://github.com/facebook/hack-codegen/issues/7 is addressed? */
    $code = file_get_contents(__DIR__.'/../codegen-hhi/'.$hhi_filename);

    $re = $s ==> '/'.preg_quote($s, '/').'/';

    $replacements = [
      $re('<?hh // decl') => '<?php',
      '/\): [^{]+{/' => ') {',
      $re('/* CODEGEN GOES HERE */') =>
        'return '.var_export($return_value, true).';',
    ];
    foreach ($replacements as $pattern => $replacement) {
      $code = preg_replace($pattern, $replacement, $code);
    }

    return $code;
  }
}
