<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use HHVM\SystemlibExtractor\SystemlibExtractor;

function get_sources(string $dir): Vector<string> {
  $rdi = new \RecursiveDirectoryIterator($dir);
  $rii = new \RecursiveIteratorIterator(
    $rdi,
    \RecursiveIteratorIterator::CHILD_FIRST,
  );
  $files = Vector {};
  foreach ($rii as $info) {
    if (!$info->isFile()) {
      continue;
    }
    $ext = $info->getExtension();
    if ($ext === 'php' || $ext === 'hhi') {
      $files[] = $info->getPathname();
    }
  }
  return $files;
}

function sources_to_yaml(
  string $destination,
  \ConstVector<string> $filenames,
) {
  foreach ($filenames as $filename) {
    fwrite(STDERR, "Processing file '".$filename."'\n");
    $source = shape(
      'type' => DocumentationSourceType::FILE,
      'name' => $filename,
      'mtime' => stat($filename)['mtime'],
    );
    $bytes = file_get_contents($filename);
    $parser = FileParser::FromData($bytes, $filename);
    (new ScannedDefinitionsYAMLBuilder($source, $parser, $destination))
      ->addFilter($x ==> ScannedDefinitionFilters::IsHHSpecific($x))
      ->addFilter($x ==> !ScannedDefinitionFilters::ShouldNotDocument($x))
      ->build();
  }
}

function hhvm_to_yaml(): void {
  $destination = __DIR__.'/../build/systemlib/';
  $sources = (Vector { })
    ->addAll(get_sources(LocalConfig::HHVM_TREE.'/hphp/system/php/'))
    ->addAll(get_sources(LocalConfig::HHVM_TREE.'/hphp/runtime/ext/'));
  sources_to_yaml($destination, $sources);

  $destination = __DIR__.'/../build/hhi/';
  $sources = get_sources(LocalConfig::HHVM_TREE.'/hphp/hack/hhi/');
  sources_to_yaml($destination, $sources);
}

hhvm_to_yaml();
