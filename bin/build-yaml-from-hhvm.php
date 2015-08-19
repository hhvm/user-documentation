<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');

use FredEmmott\DefinitionFinder\FileParser;
use HHVM\SystemlibExtractor\SystemlibExtractor;

function get_files(string $dir, Set<string> $exts): Vector<string> {
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
    if ($exts->contains($info->getExtension())) {
      $files[] = $info->getPathname();
    }
  }
  return $files;
}

function get_sources(string $dir): Vector<string> {
  return get_files($dir, Set { 'php', 'hhi' });
}

function get_yaml(string $dir): Vector<string> {
  return get_files($dir, Set { 'yml' });
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
  $systemlib = __DIR__.'/../build/systemlib/';
  $hhi = __DIR__.'/../build/hhi/';

  if (LocalConfig::REBUILD_SYSTEMLIB) {
    $sources = (Vector { })
      ->addAll(get_sources(LocalConfig::HHVM_TREE.'/hphp/system/php/'))
      ->addAll(get_sources(LocalConfig::HHVM_TREE.'/hphp/runtime/ext/'));
    sources_to_yaml($systemlib, $sources);

    $sources = get_sources(LocalConfig::HHVM_TREE.'/hphp/hack/hhi/');
    sources_to_yaml($hhi, $sources);
  }

  $destination = __DIR__.'/../build/merged/';
  $yaml = (Vector {})
    ->addAll(get_yaml($systemlib))
    ->addAll(get_yaml($hhi));
  $builder = new MergedYAMLBuilder($destination);
  foreach ($yaml as $source) {
    $builder->addDefinition(/* UNSAFE_EXPR */ \Spyc::YAMLLoad($source));
  }
  $builder->build();

  $sources = get_yaml($destination);
  $index = (new IndexBuilder())
    ->addSources(get_yaml($destination))
    ->buildIndex();
  file_put_contents(
    __DIR__.'/../build/definition-index.php',
    '<?php'.var_export($index, true),
  );
}

hhvm_to_yaml();
