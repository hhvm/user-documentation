<?hh

namespace Hack\UserDocumentation\Classes\TypeConstantsRevisited\Exampes\Referencing;

abstract class UserTC {
  abstract const type Ttc as arraykey;
  public function __construct(private this::Ttc $id) {}
  public function getID(): this::Ttc {
    return $this->id;
  }
}

class AppUserTC extends UserTC {
  const type Ttc = int;
}

function get_id_from_userTC(AppUserTC $uc): AppUserTC::Ttc {
  return $uc->getID();
}

<<__EntryPoint>>
function run(): void {
  $autc = new AppUserTC(10);
  \var_dump(get_id_from_userTC($autc));
}
