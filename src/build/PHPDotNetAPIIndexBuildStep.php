<?hh // strict

namespace HHVM\UserDocumentation;

final class PHPDotNetAPIIndexBuildStep extends BuildStep {
  use CodegenBuildStep;

  public function buildAll(): void {
    Log::i("\nPHPDotNetAPIIndex");

    $code = $this->writeCode(
      'PHPDotNetAPIIndex.hhi',
      $this->getIndexData(),
    );
    file_put_contents(
      BuildPaths::PHP_DOT_NET_API_INDEX,
      $code,
    );
  }


  private function getIndexData(): array<string, (APIDefinitionType, string)> {
    $reader = new PHPDocsIndexReader(
      file_get_contents(BuildPaths::PHP_DOT_NET_INDEX_JSON)
    );
    $defs = $reader->getAllAPIDefinitions();

    $out = [];
    foreach ($defs as $name => $id) {
      $type = explode('.', $id)[0];
      $type = APIDefinitionType::coerce($type);
      if ($type === null) {
        continue;
      }

      $url = sprintf('http://php.net/manual/en/%s.php', $id);
      $out[$name] = tuple($type, $url);
    }

    return $out;
  }
}
