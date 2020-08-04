<?hh // partial

namespace Hack\UserDocumentation\XHP\AddClass;

use type Facebook\XHP\HTML\h1;

function get_header(string $section_name): h1 {
  return (<h1 class="initial-cls">{$section_name}</h1>)
    ->addClass('added-cls')
    ->conditionClass($section_name === 'Home', 'home-cls');
}

<<__EntryPoint>>
function run(): void {
  \init_docs_autoloader();
  echo get_header('Home');
  echo "\n";
  echo get_header('Contact');
}
