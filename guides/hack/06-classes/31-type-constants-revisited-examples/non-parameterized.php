<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\TypeConstantsRevisited\NonParameterized;

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

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();

  $au = new AppUser(-1);
  \var_dump($au->getID());
}
