// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\TypeConstantsRevisited\TypeConstants;

abstract class User {
  abstract const type T as arraykey;
  public function __construct(private this::T $id) {}
  public function getID(): this::T {
    return $this->id;
  }
}

trait UserTrait {
  require extends User;
}

interface IUser {
  require extends User;
}

// We know that AppUser will only have int ids
class AppUser extends User implements IUser {
  const type T = int;
  use UserTrait;
}

class WebUser extends User implements IUser {
  const type T = string;
  use UserTrait;
}

class OtherUser extends User implements IUser {
  const type T = arraykey;
  use UserTrait;
}

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  $au = new AppUser(-1);
  \var_dump($au->getID());
  $wu = new WebUser('-1');
  \var_dump($wu->getID());
  $ou1 = new OtherUser(-1);
  \var_dump($ou1->getID());
  $ou2 = new OtherUser('-1');
  \var_dump($ou2->getID());
}
