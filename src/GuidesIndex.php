<?hh

namespace HHVM\UserDocumentation;

class GuidesIndex {
  private static function getIndex(
  ): Map<string, Map<string, Vector<string>>> {
    return require(BuildPaths::GUIDES_INDEX);
  }

  public static function getProducts(): ImmVector<string> {
    return self::getIndex()->keys()->toImmVector();
  }

  public static function getGuides(string $product): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      '%s is not in the guide index',
      $product,
    );
    return $index[$product]->keys()->toImmVector();
  }

  public static function getPages(
    string $product,
    string $guide,
  ): ImmVector<string> {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      'no guides for %s',
      $product,
    );
    invariant(
      $index[$product]->containsKey($guide),
      '%s does not contain a %s guide',
      $product,
      $guide,
    );
    return self::getIndex()[$product][$guide]->toImmVector();
  }
}
