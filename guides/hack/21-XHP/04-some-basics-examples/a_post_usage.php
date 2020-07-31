<?hh // partial

<<__EntryPoint>>
function intro_examples_a_a_post() {
  \__init_autoload();
  $get_link = <a href="http://www.example.com">I'm a normal link</a>;
  $post_link =
    <a:post href="http://www.example.com">I make a POST REQUEST</a:post>;

  echo $get_link;
  echo "\n";
  echo $post_link;
}
