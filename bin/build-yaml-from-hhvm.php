<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use HHVM\SystemlibExtractor\SystemlibExtractor;

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
    ->addAll(glob(LocalConfig::HHVM_TREE.'/hphp/system/**/*.php'))
    ->addAll(glob(LocalConfig::HHVM_TREE.'/hphp/runtime/ext/**/*.php'));
  sources_to_yaml($destination, $sources);

  /** TODO: parser doesn't understand co/contravariance */
  return;
  $destination = __DIR__.'/../build/hhi/';
  $sources = new Vector(glob(LocalConfig::HHVM_TREE.'/hphp/hack/hhi/**/*.hhi'));
  sources_to_yaml($destination, $sources);
}

hhvm_to_yaml();
