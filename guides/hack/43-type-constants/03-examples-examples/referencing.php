<?hh

namespace Hack\UserDocumentation\TypeConstants\Exampes\Examples\Referencing;

/*
 With generics, you reference the type parameter through explicit type
 parameterization declarations on all classes, functions, traits and interfaces
 using that type. In some cases that could be redundant because we know
 the type implicitly by knowing the type of the parent class.
 */
abstract class UserG<Tg as arraykey> {
  public function __construct(private Tg $id) {}
  public function getID(): Tg {
    return $this->id;
  }
}

class AppUserG<Tg as int> extends UserG<Tg> {}

// Still have to parameterize this function even though we know what Tg is.
function get_id_from_userg<Tg as int>(AppUserG<Tg> $ug): Tg {
  return $ug->getID();
}


/*
 With type constants, we can avoid having to declare the type parameter on a
 child class and function. The only thing needed in a child class is the
 concrete type binding on the abstract type constant of the parent. Otherwise,
 we just use reference the type constant as a normal property.
 */

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

function run(): void {
  $aug = new AppUserG(-1);
  \var_dump(get_id_from_userg($aug));
  $autc = new AppUserTC(-2);
  \var_dump(get_id_from_userTC($autc));
}

run();
