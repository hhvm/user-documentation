<?hh

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use HHVM\SystemlibExtractor\SystemlibExtractor;
use HHVM\UserDocumentation\ScannedDefinitionsYAMLBuilder;
use HHVM\UserDocumentation\ScannedDefinitionFilters;
use HHVM\UserDocumentation\DocumentationSourceType;

function systemlib_to_yaml(): void {
  $destination = __DIR__.'/../build/yaml/';

  $mtime = stat(PHP_BINARY)['mtime'];
  $extractor = (new SystemlibExtractor());
  foreach ($extractor->getSectionNames() as $section) {
    $source = shape(
      'type' => DocumentationSourceType::ELF_SECTION,
      'name' => $section,
      'mtime' => $mtime,
    );

    $bytes = $extractor->getSectionContents($section);
    $parser = FileParser::FromData($bytes, $section);
    (new ScannedDefinitionsYAMLBuilder($source, $parser, $destination))
      ->addFilter($x ==> ScannedDefinitionFilters::IsHHSpecific($x))
      ->addFilter($x ==> !ScannedDefinitionFilters::ShouldNotDocument($x))
      ->build();
  }
}

systemlib_to_yaml();
