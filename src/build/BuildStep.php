<?hh // strict

namespace HHVM\UserDocumentation;

abstract class BuildStep {
  abstract public function buildAll(): void;

  protected static function findSources(
    string $root,
    \ConstSet<string> $extensions,
  ): Iterable<string> {
    $rdi = new \RecursiveDirectoryIterator($root);
    $rii = new \RecursiveIteratorIterator(
      $rdi,
      \RecursiveIteratorIterator::CHILD_FIRST,
    );
    $files = Vector {};
    foreach ($rii as $info) {
      if (!$info->isFile()) {
        continue;
      }
      if ($extensions->contains($info->getExtension())) {
        $files[] = $info->getPathname();
      }
    }
    return $files;
  }
}
