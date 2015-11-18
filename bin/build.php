<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');
function hhvm_to_yaml(): void {
  (new RawYAMLBuildStep())->buildAll();
  (new MergedYAMLBuildStep())->buildAll();

  (new GuidesIndexBuildStep())->buildAll();
  (new APIIndexBuildStep())->buildAll();

  (new APILegacyRedirectsBuildStep())->buildAll();

  (new SyntaxHighlightCSSBuildStep())->buildAll();
  (new StaticResourceMapBuildStep())->buildAll();

  (new MergedMarkdownBuildStep())->buildAll();

  (new GuidesHTMLBuildStep())->buildAll();
  (new APIHTMLBuildStep())->buildAll();

  (new BuildIDBuildStep())->buildAll();
}

hhvm_to_yaml();

echo "\n"; // Make the bash prompt nice after :p
