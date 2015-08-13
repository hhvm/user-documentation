<?hh

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use FredEmmott\DefinitionFinder\ScannedBase;
use HHVM\SystemlibExtractor\SystemlibExtractor;

function filter_hh_specific(ScannedBase $def): bool {
  return
    strpos($def->getName(), 'HH\\') === false
    && strpos($def->getName(), '__SystemLib') === false
    && ! $def->getAttributes()->containsKey('__HipHopSpecific')
    && strpos($def->getName(), 'fb_') !== 0
    && strpos($def->getName(), 'hphp_') !== 0;
}

function dump_unmarked_hh_specific(): void {
  $defs = Vector { };

  $extractor = new SystemlibExtractor();
  foreach ($extractor->getSectionNames() as $section) {
    $bytes = $extractor->getSectionContents($section);
    $parser = FileParser::FromData($bytes, $section);

    $defs = $defs
      ->addAll($parser->getClasses())
      ->addAll($parser->getInterfaces())
      ->addAll($parser->getTraits())
      ->addAll($parser->getFunctions());
  }

  $defs = $defs
    ->filter(fun('filter_hh_specific'))
    ->map($def ==> $def->getName())
    ->toArray();
  sort($defs);

  $php_file = tempnam(sys_get_temp_dir(), 'PHPCHECK');
  file_put_contents(
    $php_file,
    '<?php '.
    '$defs = '.var_export($defs, true).';'.
    'foreach ($defs as $def) {'.
      'if (!('.
        'class_exists($def)'.
        '|| interface_exists($def)'.
        '|| trait_exists($def)'.
        '|| function_exists($def)'.
       ')) {'.
        'print $def."\n";'.
      '}'.
    '}'
  );
  print shell_exec('php '.escapeshellarg($php_file));
  unlink($php_file);
}

dump_unmarked_hh_specific();
