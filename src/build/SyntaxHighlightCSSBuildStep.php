<?hh // strict

namespace HHVM\UserDocumentation;

final class SyntaxHighlightCSSBuildStep extends BuildStep {
  const string PROVIDER = LocalConfig::ROOT.'/md-render/syntax-highlight-css.rb';

  public function buildAll(): void {
    Log::i("\nSyntaxHighlightCSS");
    $css = null;
    $exit_code = null;
    exec(self::PROVIDER, /* & */ $css, /* & */ $exit_code);
    invariant(
      $exit_code === 0,
      'Failed to get CSS for syntax highlighting'
    );

    file_put_contents(
      BuildPaths::SYNTAX_HIGHLIGHT_CSS,
      $css,
    );
  }
}
