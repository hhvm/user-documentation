<?hh // strict

namespace HHVM\UserDocumentation;

final class Guides {
  public static function normalizeName(
    GuidesProduct $product,
    string $guide,
    string $page,
  ): string {
    // If the guide name and the page name are the same, only print one of them.
    // If there is only one page in a guide, only print the guide name.
    return
      (
        strcasecmp($guide, $page) === 0
        || count(GuidesIndex::getPages($product, $guide)) === 1
      )
        ? ucwords(strtr($guide, '-', ' '))
        : ucwords(strtr($guide.': '.$page, '-', ' '));
  }

  public static function normalizePart(
    string $part,
  ): string {
    return ucwords(strtr($part, '-', ' '));
  }
}
