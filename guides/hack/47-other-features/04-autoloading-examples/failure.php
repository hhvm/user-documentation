<?hh

function alf_autoload_fail(string $kind, string $name) {
  echo "Autoload Fail: $kind with name $name failed to load\n";
}

// The al_userid type alias was autloaded below.
function alf_testme(al_userid $id): bool {
  return true;
}

function alf_run(): void {
  // This should typecheck but does not
  // UNSAFE
  $map = array(
    'function' => array('al_blahblah' => 'A.inc.php', 'al_bar' => 'B.inc.php'),
    'class' => array('AL_A' => 'A.inc.php'),
    'constant' => array('AL_BAZ' => 'B.inc.php', 'AL_YAM' => 'B.inc.php'),
    'type' => array('al_userid' => 'A.inc.php'), // type alias
    'failure' => function($kind, $name) {echo "Autoload fail: $kind, $name\n";}
  );
  \HH\autoload_set_paths($map, __DIR__ . '/');
  var_dump(al_blahblah());
}

alf_run();

