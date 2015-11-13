<?hh

namespace Hack\UserDocumentation\TypeConstants\Intro\Examples\NonParameterized;

abstract class User {
  public function __construct(private int $id) {}
  public function getID(): int {
    return $this->id;
  }
}

trait UserTrait {
  require extends User;
}

interface IUser {
  require extends User;
}

class AppUser extends User implements IUser {
  use UserTrait;
}

function run(): void {
  $au = new AppUser(-1);
  var_dump($au->getID());
}

run();
