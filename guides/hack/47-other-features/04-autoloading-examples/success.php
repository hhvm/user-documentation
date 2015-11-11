<?hh

function al_autoload_fail(string $kind, string $name) {
  echo "Autoload Fail: $kind with name $name failed to load\n";
}

// The al_userid type alias was autloaded below.
function al_testme(al_userid $id): bool {
  return true;
}

function al_run(): void {
  // This should typecheck but does not
  // UNSAFE
  $map = array(
    'function' => array('al_foo' => 'A.inc.php', 'al_bar' => 'B.inc.php'),
    'class' => array('AL_A' => 'A.inc.php'),
    'constant' => array('AL_BAZ' => 'B.inc.php', 'AL_YAM' => 'B.inc.php'),
    'type' => array('al_userid' => 'A.inc.php'), // type alias
    'failure' => 'al_autoload_fail'
  );
  \HH\autoload_set_paths($map, __DIR__ . '/');
  var_dump(al_foo());
  var_dump(AL_BAZ);
  var_dump(new AL_A());
  var_dump(al_testme(4));
}

al_run();
