<?hh // strict

use HHVM\UserDocumentation\{
  APIDefinitionType,
  APIProduct,
  GuidesProduct
};

final class UriPattern extends \Facebook\HackRouter\UriPattern {
  public function apiProduct(string $name): this {
    return $this->enum(APIProduct::class, $name);
  }

  public function guidesProduct(string $name): this {
    return $this->enum(GuidesProduct::class, $name);
  }

  public function definitionType(string $name): this {
    return $this->enum(APIDefinitionType::class, $name);
  }
}
