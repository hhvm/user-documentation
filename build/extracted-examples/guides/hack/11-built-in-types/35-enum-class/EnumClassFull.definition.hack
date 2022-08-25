// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\BuiltInTypes\EnumClass\EnumClassFull;

use namespace HH\Lib\Str;

function expect_string(string $str): void {
  echo 'expect_string called with: '.$str."\n";
}

interface IKey {
  public function name(): string;
}

abstract class Key<T> implements IKey {
  public function __construct(private string $name)[] {}
  public function name(): string {
    return $this->name;
  }
  public abstract function coerceTo(mixed $data): T;
}

class IntKey extends Key<int> {
  public function coerceTo(mixed $data): int {
    return $data as int;
  }
}

class StringKey extends Key<string> {
  public function coerceTo(mixed $data): string {
    // random logic can be implemented here
    $s = $data as string;
    // let's make everything in caps
    return Str\capitalize($s);
  }
}
