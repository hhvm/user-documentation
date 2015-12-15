<?hh // strict

namespace HHVM\UserDocumentation;

final class PHPDotNetArticleRedirectsBuildStep extends BuildStep {
  use CodegenBuildStep;

  public function buildAll(): void {
    Log::i("\nPHPDotNetArticleRedirectsBuild");
    $reader = new PHPDocsIndexReader(
      file_get_contents(BuildPaths::PHP_DOT_NET_INDEX_JSON)
    );

    $index = [];
    $articles = $reader->getArticles();
    foreach ($articles as $_ => $id) {
      $index[$id] = sprintf('http://php.net/manual/en/%s.php', $id);
    }

    $code = $this->writeCode(
      'PHPDotNetArticleRedirectData.hhi',
      $index,
    );

    file_put_contents(
      BuildPaths::PHP_DOT_NET_ARTICLE_REDIRECTS,
      $code,
    );
  }
}
