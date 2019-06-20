<?hh // strict

namespace HHVM\UserDocumentation\Tests;

use namespace HH\Lib\PseudoRandom;
use function HHVM\UserDocumentation\_Private\execute_async;

final class TemporaryDirectory implements \IAsyncDisposable {
  private string $path;
  public function __construct() {
    $this->path = \sys_get_temp_dir().
      '/hack-tests-'.
      \bin2hex(PseudoRandom\string(16));
    \mkdir($this->path);
  }

  public function getPath(): string {
    return $this->path;
  }

  public async function __disposeAsync(): Awaitable<void> {
    await execute_async(null, 'rm', '-rf', '--', $this->path);
  }
}
