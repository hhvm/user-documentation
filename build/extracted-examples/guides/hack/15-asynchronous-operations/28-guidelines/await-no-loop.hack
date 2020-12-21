// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\AsynchronousOperations\Guidelines\AwaitNoLoop;

use namespace HH\Lib\Vec;

class User {
  public string $name;

  protected function __construct(string $name) {
    $this->name = $name;
  }

  public static function get_name(int $id): User {
    return new User(\str_shuffle("ABCDEFGHIJ").\strval($id));
  }
}

async function load_user(int $id): Awaitable<User> {
  // Load user from somewhere (e.g., database).
  // Fake it for now
  return User::get_name($id);
}

async function load_users_no_loop(vec<int> $ids): Awaitable<vec<User>> {
  return await Vec\map_async(
    $ids,
    async $id ==> await load_user($id),
  );
}

<<__EntryPoint>>
function runMe(): void {
  \init_docs_autoloader();

  $ids = vec[1, 2, 5, 99, 332];
  $result = \HH\Asio\join(load_users_no_loop($ids));
  \var_dump($result[4]->name);
}
