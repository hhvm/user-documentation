<?hh // strict

namespace HHVM\UserDocumentation;

final class SASSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/sass/build.rb';

  public function buildAll(): void {
    Log::i("\nSASS");      
    $css = null;
    $exit_code = null;
    exec(self::PROVIDER, /* & */ $css, /* & */ $exit_code);
    invariant(
      $exit_code === 0,
      'Failed to build core CSS'
    );

    file_put_contents(
      BuildPaths::CORE_CSS,
      $css,
    );
  }
}
