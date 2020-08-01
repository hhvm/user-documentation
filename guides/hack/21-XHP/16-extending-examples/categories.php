<?hh // partial

<<__EntryPoint>>
function extending_examples_categories_run(): void {
  \__init_autoload();
  $my_text = <my-text />;
  $my_text->appendChild(<em>"Hello!"</em>); // This is a %phrase
  echo $my_text;

  $my_text = <my-text />;
  $my_text->appendChild("Bye!"); // This is pcdata, not a phrase
  // Won't print out "Bye!" because render is only returing %phrase children
  echo $my_text;
}
