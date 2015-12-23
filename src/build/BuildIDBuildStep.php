<?hh // strict

namespace HHVM\UserDocumentation;

final class BuildIDBuildStep extends BuildStep {
  public function buildAll(): void {
    Log::i("\nBuildID");
    $docsite_rev = $this->getHead(__DIR__.'/../../');
    $hhvm_rev = $this->getHead(LocalConfig::HHVM_TREE);

    $build_id = strftime('%FT%T%z').':'.$docsite_rev.':'.$hhvm_rev;
    file_put_contents(BuildPaths::BUILD_ID, $build_id);
  }

  private function getHead(string $path): string {
    $rev = shell_exec(
      sprintf(
        "GIT_DIR=%s git rev-parse HEAD",
        escapeshellarg($path.'/.git'),
      )
    );
    return trim($rev);
  }
}
