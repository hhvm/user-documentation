<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/hh_autoload.php');
function build_site(?Traversable<string> $filters = null): void {
  if (!is_dir(LocalConfig::BUILD_DIR)) {
    mkdir(LocalConfig::BUILD_DIR);
  }

  $steps = ImmVector {
    // No Dependencies
    RawYAMLBuildStep::class,
    MergedYAMLBuildStep::class,
    FetchPHPDotNetIndexBuildStep::class,
    PHPIniSupportInHHVMBuildStep::class,

    // Needs getting the PHP ini settings HHVM supports
    PHPIniSupportInHHVMMarkdownBuildStep::class,

    // Needs the YAML
    GuidesIndexBuildStep::class,
    APIIndexBuildStep::class,

    // Needs the indices
    PHPDotNetAPIIndexBuildStep::class,
    UnifiedAPIIndexBuildStep::class,
    SiteMapBuildStep::class,

    APILegacyRedirectsBuildStep::class,
    PHPDotNetArticleRedirectsBuildStep::class,

    // Static Resources
    SyntaxHighlightCSSBuildStep::class,
    SASSBuildStep::class,
    StaticResourceMapBuildStep::class,

    // Needs the static resources
    MergedMarkdownBuildStep::class,

    // Needs the Markdown
    GuidesHTMLBuildStep::class,
    APIHTMLBuildStep::class,

    // Build ID
    BuildIDBuildStep::class,
  };

  if ($filters === null) {
    foreach ($steps as $step) {
      (new $step())->buildAll();
    }
    return;
  }

  foreach ($steps as $step) {
    foreach ($filters as $filter) {
      if (stripos($step, $filter) !== false) {
        (new $step())->buildAll();
        break;
      }
    }
  }
}

if (array_key_exists(1, $argv)) {
  build_site(array_slice($argv, 1));
} else {
  build_site();
}

echo "\n"; // Make the bash prompt nice after :p
