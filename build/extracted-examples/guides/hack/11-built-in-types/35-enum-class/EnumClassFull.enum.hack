// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassFull;

enum class EKeys: IKey {
  // here are a default key, but this could be left empty
  Key<string> NAME = new StringKey('NAME');
}

abstract class DictBase {
  // type of the keys, left abstract for now
  abstract const type TKeys as EKeys;
  // actual data storage
  private dict<string, mixed> $raw_data = dict[];

  // generic code written once which enforces type safety
  public function get<T>(\HH\MemberOf<this::TKeys, Key<T>> $key): ?T {
    $name = $key->name();
    $raw_data = idx($this->raw_data, $name);
    // key might not be set
    if ($raw_data is nonnull) {
      $data = $key->coerceTo($raw_data);
      return $data;
    }
    return null;
  }

  public function set<T>(\HH\MemberOf<this::TKeys, Key<T>> $key, T $data): void {
    $name = $key->name();
    $this->raw_data[$name] = $data;
  }
}
