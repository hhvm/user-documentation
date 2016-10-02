<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/hh_autoload.php');
function build_site(?Traversable<string> $filters = null): void {
  if (!is_dir(LocalConfig::BUILD_DIR)) {
    mkdir(LocalConfig::BUILD_DIR);
  }

  $steps = Vector {
    // No Dependencies
    RoutingCodegenBuildStep::class,
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

  };

  if ($filters !== null) {
    $steps = $steps->filter(
      function (classname<BuildStep> $step): bool use ($filters) {
        foreach ($filters as $filter) {
          if (stripos($step, $filter) !== false) {
            return true;
          }
        }
        return false;
      }
    );
  }

  $steps[] = BuildIDBuildStep::class;

  foreach ($steps as $step) {
    (new $step())->buildAll();
  }
}

if (array_key_exists(1, $argv)) {
  build_site(array_slice($argv, 1));
} else {
  build_site();
}

echo "\n"; // Make the bash prompt nice after :p
