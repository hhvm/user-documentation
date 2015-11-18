<?hh // strict

namespace HHVM\UserDocumentation;

final class SyntaxHighlightCSSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/md-render/syntax-highlight-css.rb';

  public function buildAll(): void {
    Log::i("\nSyntaxHighlightCSS");
    $css = null;
    exec(self::PROVIDER, /* & */ $css);

    file_put_contents(
      BuildPaths::SYNTAX_HIGHLIGHT_CSS,
      $css,
    );
  }
}
