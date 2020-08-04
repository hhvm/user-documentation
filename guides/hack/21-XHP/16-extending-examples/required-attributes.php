<?hh // partial

use namespace Facebook\XHP;

<<__EntryPoint>>
function extending_examples_attributes_run(): void {
  \init_docs_autoloader();
  /* HH_FIXME[4314] Missing required attribute is also a typechecker error. */
  $uinfo = <user_info />;
  // Can't render :user-info for an echo without setting the required userid
  // attribute
  try {
    echo $uinfo;
  } catch (XHP\AttributeRequiredException $ex) {
    var_dump($ex->getMessage());
  }
  $uinfo->setAttribute('userid', 1000);
  $uinfo->setAttribute('name', 'Joel');
  echo $uinfo;
}
