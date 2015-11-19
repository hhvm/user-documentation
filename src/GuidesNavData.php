<?hh // strict
namespace HHVM\UserDocumentation;

final class GuidesNavData {
  public static function getNavData(): array<string, NavDataNode> {
    $nav_data = [];
    foreach (GuidesIndex::getIndex() as $name => $product_guides) {
      $nav_data[$name] = shape(
        'urlPath' => URLBuilder::getPathForProductGuides($name),
        'children' => self::getNavDataForProduct(
          GuidesProduct::assert($name),
          $product_guides,
        ),
      );
    }
    return $nav_data;
  }

  private static function getNavDataForProduct(
    GuidesProduct $product,
    Map<string, Map<string, string>> $product_guides,
  ): array<string, NavDataNode> {
    $nav_data = [];
    foreach ($product_guides as $topic => $pages) {
      $nav_data[self::pathToName($topic)] = shape(
        'urlPath' => URLBuilder::getPathForGuide($product, $topic),
        'children' => self::getNavDataForGuide(
          $product,
          $topic,
          $pages,
        ),
      );
    }
    return $nav_data;
  }

  private static function getNavDataForGuide(
    GuidesProduct $product,
    string $topic,
    Map<string, string> $pages,
  ): array<string, NavDataNode> {
    $nav_data = [];
    foreach ($pages as $title => $html_file) {
      $nav_data[self::pathToName($title)] = shape(
        'urlPath' => URLBuilder::getPathForGuidePage($product, $topic, $title),
        'children' => [],
      );
    }
    return $nav_data;
  }

  public static function pathToName(string $name): string {
    switch ($name) {
      case 'hh_server':
        return $name;
      case 'faq':
        return 'FAQ';
      default:
        return ucwords(strtr($name, '-', ' '));
    }
  }
}
