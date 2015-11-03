<?hh
namespace HHVM\UserDocumentation;

require(__DIR__.'/../vendor/autoload.php');
function hhvm_to_yaml(): void {
  (new GuidesHTMLBuildStep())->buildAll();
}

hhvm_to_yaml();
