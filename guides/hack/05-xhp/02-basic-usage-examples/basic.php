<?hh

namespace Hack\UserDocumentation\XHP\BasicUsage\Examples\Basic;

require __DIR__ . "/../../../../vendor/autoload.php";

function basic_xhp(): void {
  var_dump(
    <div>
       My Text
       <strong>My Bold Text</strong>
       <i>My Italic Text</i>
    </div>);
}

basic_xhp();
