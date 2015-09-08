<?hh

namespace HHVM\UserDocumentation;

class GuidesIndex {
  private static function getIndex(
  ): Map<string, Map<string, Map<string, string>>> {
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
    return self::getIndex()[$product][$guide]->keys()->toImmVector();
  }

  public static function getFileForPage(
    string $product,
    string $guide,
    string $page,
  ): string {
    $index = self::getIndex();
    invariant(
      $index->containsKey($product),
      'Product %s does not exist',
      $product,
    );
    invariant(
      $index[$product]->containsKey($guide),
      'Product %s does not contain guide %s',
      $product,
      $guide,
    );
    invariant(
      $index[$product][$guide]->containsKey($page),
      'Guide %s/%s does not include page %s',
      $product,
      $guide,
      $page,
    );
    return BuildPaths::GUIDES_HTML.'/'.$index[$product][$guide][$page];
  }
}
