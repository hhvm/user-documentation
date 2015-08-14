<?hh

namespace HHVM\UserDocumentation;

final class MergedDataBuilder {
  private Map<string, mixed> $data;
  public function __construct(
    \ConstMap<string, mixed> $initial,
  ) {
    $this->data = $initial->toMap();
  }

  public function addData(\ConstMap<string, mixed> $new): this {
    $this->mergeField($new, 'generics');
    $this->mergeField($new, 'methods');
    $this->mergeField($new, 'docComment');
    return $this;
  }

  public function build(): Map<string, mixed> {
    return $this->data;
  }

  private function mergeField(\ConstMap<string, mixed> $new, string $key): void {
    if (!$new->containsKey($key)) {
      return;
    }

    $value = $new[$key];
    if ($value !== null && $value != []) {
      $this->data[$key] = $value;
    }
  }
}
