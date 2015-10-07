<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');
function hhvm_to_yaml(): void {
  (new RawYAMLBuildStep())->buildAll();
  (new MergedYAMLBuildStep())->buildAll();
  (new MergedMarkdownBuildStep())->buildAll();
  (new GuidesHTMLBuildStep())->buildAll();
  (new APIHTMLBuildStep())->buildAll();
}

hhvm_to_yaml();
