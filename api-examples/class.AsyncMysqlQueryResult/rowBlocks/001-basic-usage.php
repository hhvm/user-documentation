<?hh // partial

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\QueryResult\rowBlocks;

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

async function connect(
  \AsyncMysqlConnectionPool $pool,
): Awaitable<\AsyncMysqlConnection> {
  return await $pool->connect(
    CI::$host,
    CI::$port,
    CI::$db,
    CI::$user,
    CI::$passwd,
  );
}
async function simple_query(): Awaitable<int> {
  $pool = new \AsyncMysqlConnectionPool(darray[]);
  $conn = await connect($pool);
  $result = await $conn->query('SELECT * FROM test_table WHERE userID < 50');
  // A call to $result->rowBlocks() actually pops the first element of the
  // row block Vector. So it mutates it.
  $row_blocks = $result->rowBlocks();
  if ($row_blocks->count() > 0) {
    // An AsyncMysqlRowBlock
    $row_block = $row_blocks[0];
    \var_dump($row_block->fieldName(2)); // string
  } else {
    \var_dump('nothing');
  }
  $conn->close();
  return $result->numRows();
}

function run(): void {
  $r = \HH\Asio\join(simple_query());
  \var_dump($r);
}

<<__EntryPoint>>
function basic_usage_main(): void {
  require __DIR__.'/../../__includes/async_mysql_connect.inc.php';

  run();
}
