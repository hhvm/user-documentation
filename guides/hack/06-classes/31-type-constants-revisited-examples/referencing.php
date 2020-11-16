<?hh

// WARNING: Contains some auto-generated boilerplate code, see:
// HHVM\UserDocumentation\MarkdownExt\ExtractedCodeBlocks\FilterBase::addBoilerplate

namespace HHVM\UserDocumentation\Guides\Hack\Classes\TypeConstantsRevisited\Referencing;

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
  \init_docs_autoloader();

  $autc = new AppUserTC(10);
  \var_dump(get_id_from_userTC($autc));
}
