<?hh // strict
namespace HHVM\UserDocumentation;

final class APINavData {
  public static function getNavData(): array<string, NavDataNode> {
    return [
      'Classes' => self::getNavDataForClasses(APIDefinitionType::CLASS_DEF),
      'Interfaces' => self::getNavDataForClasses(APIDefinitionType::INTERFACE_DEF),
      'Traits' => self::getNavDataForClasses(APIDefinitionType::TRAIT_DEF),
      'Functions' => shape(
        'name' => 'Functions',
        'urlPath' => '/hack/reference/function/',
        'children' => self::getNavDataForFunctions(),
      ),
    ];
  }

  public static function getRootNameForType(
    APIDefinitionType $class_type,
  ): string {
    switch ($class_type) {
      case APIDefinitionType::CLASS_DEF:
        return 'Classes';
      case APIDefinitionType::INTERFACE_DEF:
        return 'Interfaces';
      case APIDefinitionType::TRAIT_DEF:
        return 'Traits';
      case APIDefinitionType::FUNCTION_DEF:
        return 'Functions';
    }
  }

  private static function getNavDataForClasses(
    APIDefinitionType $class_type,
  ): NavDataNode {
    $nav_data = [];
    $classes = APIIndex::getClassIndex($class_type);

    foreach ($classes as $class) {
      $nav_data[$class['name']] = shape(
        'name' => $class['name'],
        'urlPath' => $class['urlPath'],
        'children' => self::getNavDataForMethods($class['methods']),
      );
    }
    return shape(
      'name' => self::getRootNameForType($class_type),
      'urlPath' => '/hack/reference/'.$class_type.'/',
      'children' => $nav_data,
    );
  }

  private static function getNavDataForMethods(
    array<string, APIMethodIndexEntry> $methods,
  ): array<string, NavDataNode> {
    $nav_data = [];
    foreach ($methods as $method) {
      $nav_data[$method['name']] = shape(
        'name' => $method['name'],
        'urlPath' => $method['urlPath'],
        'children' => [],
      );
    }
    return $nav_data;
  }

  private static function getNavDataForFunctions(
  ): array<string, NavDataNode> {
    $functions = APIIndex::getFunctionIndex();

    $nav_data = [];
    foreach ($functions as $function) {
      $nav_data[$function['name']] = shape(
        'name' => $function['name'],
        'urlPath' => $function['urlPath'],
        'children' => [],
      );
    }
    return $nav_data;
  }
}
