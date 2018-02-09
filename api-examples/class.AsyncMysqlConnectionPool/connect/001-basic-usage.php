<?hh

namespace Hack\UserDocumentation\API\Examples\AsyncMysql\PoolConn\Connect;

require __DIR__ .'/../../__includes/async_mysql_connect.inc.php';

use \Hack\UserDocumentation\API\Examples\AsyncMysql\ConnectionInfo as CI;

class MyPool {
  private \AsyncMysqlConnectionPool $pool;

  public function __construct() {
    $this->pool = new \AsyncMysqlConnectionPool(array());
  }

  public function getPool(): \AsyncMysqlConnectionPool {
    return $this->pool;
  }

  public async function connect(): Awaitable<\AsyncMysqlConnection> {
    return await $this->pool->connect(
      CI::$host,
      CI::$port,
      CI::$db,
      CI::$user,
      CI::$passwd
    );
  }
}


async function get_num_rows(\AsyncMysqlConnection $conn): Awaitable<int> {
  $result = await $conn->query('SELECT * FROM test_table');
  return $result->numRows();
}

async function get_row_data(\AsyncMysqlConnection $conn):
  Awaitable<Vector<Vector>> {
  $result = await $conn->query('SELECT * FROM test_table');
  return $result->vectorRows();
}

async function run_it_1(MyPool $pool): Awaitable<void> {
  $conn = await $pool->connect();
  $rows = await get_num_rows($conn);
  \var_dump($rows);
}

async function run_it_2(MyPool $pool): Awaitable<void> {
  $conn = await $pool->connect();
  $data = await get_row_data($conn);
  \var_dump($data->count());
  // Should show only one created pool connection since we are pooling it
  \var_dump($pool->getPool()->getPoolStats());
}

function run(): void {
  $pool = new MyPool();
  \HH\Asio\join(run_it_1($pool));
  \HH\Asio\join(run_it_2($pool));
}

run();
