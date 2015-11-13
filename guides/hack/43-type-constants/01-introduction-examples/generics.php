<?hh

namespace Hack\UserDocumentation\TypeConstants\Intro\Examples\Generics;

abstract class User<T as arraykey> {
  public function __construct(private T $id) {}
  public function getID(): T {
    return $this->id;
  }
}

trait UserTrait<T as arraykey> {
  require extends User<T>;
}

interface IUser<T as arraykey> {
  require extends User<T>;
}

// We know that AppUser will only have int ids
class AppUser extends User<int> implements IUser<int> {
  use UserTrait<int>;
}

class WebUser extends User<string> implements IUser<string> {
  use UserTrait<string>;
}

class OtherUser extends User<arraykey> implements IUser<arraykey> {
  use UserTrait<arraykey>;
}

function run(): void {
  $au = new AppUser(-1);
  var_dump($au->getID());
  $wu = new WebUser('-1');
  var_dump($wu->getID());
  $ou1 = new OtherUser(-1);
  var_dump($ou1->getID());
  $ou2 = new OtherUser('-1');
  var_dump($ou2->getID());
}

run();
