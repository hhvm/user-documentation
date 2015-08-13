<?hh

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use HHVM\SystemlibExtractor\SystemlibExtractor;
use HHVM\UserDocumentation\DocumentationBundleBuilder;
use HHVM\UserDocumentation\DocumentationBundleFilters;
use HHVM\UserDocumentation\DocumentationSourceType;

function systemlib_to_yaml(): void {
  $source = shape(
    'type' => DocumentationSourceType::ELF_SECTION,
    'name' => 'systemlib',
    'mtime' => stat(PHP_BINARY)['mtime'],
  );

  $systemlib = (new SystemlibExtractor())->getSectionContents('systemlib');
  $parser = FileParser::FromData($systemlib, 'systemlib');
  $bundle = (new DocumentationBundleBuilder($source, $parser))
    ->addFilter($x ==> DocumentationBundleFilters::IsHHSpecific($x))
    ->addFilter($x ==> !DocumentationBundleFilters::ShouldNotDocument($x))
    ->toBundle();
  print Spyc::YAMLDump($bundle);
}

systemlib_to_yaml();
