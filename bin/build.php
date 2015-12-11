<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');
function build_site(): void {
  if (!is_dir(LocalConfig::BUILD_DIR)) {
    mkdir(LocalConfig::BUILD_DIR);
  }

  (new FetchPHPDotNetIndexBuildStep())->buildAll();

  (new RawYAMLBuildStep())->buildAll();
  (new MergedYAMLBuildStep())->buildAll();

  (new GuidesIndexBuildStep())->buildAll();
  (new APIIndexBuildStep())->buildAll();

  (new UnifiedAPIIndexBuildStep())->buildAll();
  (new SiteMapBuildStep())->buildAll();

  (new APILegacyRedirectsBuildStep())->buildAll();
  (new PHPDotNetArticleRedirectsBuildStep())->buildAll();

  (new SASSBuildStep())->buildAll();
  (new SyntaxHighlightCSSBuildStep())->buildAll();
  (new StaticResourceMapBuildStep())->buildAll();

  (new MergedMarkdownBuildStep())->buildAll();

  (new GuidesHTMLBuildStep())->buildAll();
  (new APIHTMLBuildStep())->buildAll();

  (new BuildIDBuildStep())->buildAll();

}

build_site();

echo "\n"; // Make the bash prompt nice after :p
