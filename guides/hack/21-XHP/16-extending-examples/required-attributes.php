<?hh // partial

<<__EntryPoint>>
function extending_examples_attributes_run(): void {
  \init_docs_autoloader();
  $uinfo = <user_info />;
  // Can't render :user-info for an echo without setting the required userid
  // attribute
  try {
    echo $uinfo;
  } catch (\XHPAttributeRequiredException $ex) {
    var_dump($ex->getMessage());
  }
  $uinfo->setAttribute('userid', 1000);
  $uinfo->setAttribute('name', 'Joel');
  echo $uinfo;
}
