<?hh

namespace Hack\UserDocumentation\API\Examples\Vector\LastKey;

function echoLastKey(Vector<string> $v): void {
  $last_key = $v->lastKey();
  if ($last_key !== null) {
    echo 'Last key: '.$last_key."\n";
  } else {
    echo 'No last key (Vector is empty)'."\n";
  }
}

// Will print "Last key: 3"
echoLastKey(Vector {'red', 'green', 'blue', 'yellow'});

// Will print "No last key (Vector is empty)"
echoLastKey(Vector {});
