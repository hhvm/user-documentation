<?hh // strict
namespace HHVM\UserDocumentation;

require(BuildPaths::APIDOCS_INDEX);

use namespace HH\Lib\{C, Str};

class APIIndex {
  public static function getIndex(
  ): APIIndexShape {
    return APIIndexData::getIndex();
  }

  public static function getIndexForType(
    APIDefinitionType $type,
  ): array<string, APIIndexEntry> {
    $index = Shapes::toArray(self::getIndex());
    invariant(
      array_key_exists($type, $index),
      'invalid type: %s',
      (string) $type,
    );
    // UNSAFE
    return $index[$type];
  }

  public static function getFunctionIndex(
  ): array<string, APIFunctionIndexEntry> {
    return self::getIndex()['function'];
  }

  public static function getClassIndex(
    APIDefinitionType $type,
  ): array<string, APIClassIndexEntry> {
    invariant(
      $type !== APIDefinitionType::FUNCTION_DEF,
      'functions are not classes',
    );
    // UNSAFE
    return self::getIndex()[$type];
  }

  public static function search(
    string $term,
  ): SearchResultSet {
    $results = new SearchResultSet();
    foreach (APIDefinitionType::getValues() as $type) {
      $results->addAll(
        self::searchEntries($term, $type)
      );
    }
    return $results;
  }

  private static function searchEntries (
    string $term,
    APIDefinitionType $type,
  ): SearchResultSet {
    $terms = Str\split($term, ' ');
    $results = new SearchResultSet();

    $entries = self::getIndexForType($type);
    foreach ($entries as $_ => $entry) {
      $name = $entry['name'];
      if (C\every($terms, $term ==> Str\contains_ci($name, $term))) {
        $results->addAPIResult($type, $entry);
      }
    }

    return $results;
  }

  public static function getDataForFunction(
    string $name,
  ): APIFunctionIndexEntry {
    $index = self::getIndex();
    invariant(
      array_key_exists($name, $index['function']),
      'function %s does not exist',
      $name,
    );
    return $index['function'][$name];
  }

  public static function getDataForClass(
    APIDefinitionType $class_type,
    string $class_name,
  ): APIClassIndexEntry {
    $index = self::getClassIndex($class_type);
    invariant(
      array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    return $index[$class_name];
  }

  public static function getDataForMethod(
    APIDefinitionType $class_type,
    string $class_name,
    string $method_name,
  ): APIMethodIndexEntry {
    $index = self::getClassIndex($class_type);
    invariant(
      array_key_exists($class_name, $index),
      'class %s does not exist',
      $class_name,
    );
    $class = $index[$class_name];
    $methods = $class['methods'];
    invariant(
      array_key_exists($method_name, $methods),
      'Method %s::%s does not exist',
      $class_name,
      $method_name,
    );
    return $methods[$method_name];
  }
}
