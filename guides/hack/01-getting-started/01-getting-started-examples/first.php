<?hh

namespace Hack\UserDocumentation\Quickstart\Examples\First;

enum Food : string {
  VEGETABLE = 'Vegetable';
  MEAT = 'Meat';
}

interface Animal {
  // You can eat and move at the same time so allow them to be async by
  // returning an Awaitable
  public function eat(Food $type): Awaitable<(Food, int, bool)>;
  public function move(int $distance): Awaitable<void>;
}

class Human implements Animal {
  const ONE_SECOND = 1000000; // usleep takes microseconds
  // constructor parameter promotion
  public function __construct(private string $name) {}

  public async function eat(Food $type): Awaitable<(Food, int, bool)> {
    // pretend 3 seconds is the human eating time for vegetables and 5 for meat
    $eat_time = $type === Food::VEGETABLE ? 3 : 5;
    await \HH\Asio\usleep(self::ONE_SECOND * $eat_time);
    // I am not going to finish all my vegetables!!
    $finished = $type !== Food::VEGETABLE;
    return tuple($type, $eat_time, $finished);
  }

  public async function move(int $distance_in_feet): Awaitable<void> {
    // pretend it takes a second to move one foot
    await \HH\Asio\usleep($distance_in_feet * self::ONE_SECOND);
  }

  public function getName(): string {
    return $this->name;
  }
}

async function typical_day(): Awaitable<void> {
  $start = time();
  $human = new Human('Jane');
  list($what, $eat_time, $finished) = await $human->eat(Food::VEGETABLE);
  await $human->move(2);
  $end = time();
  echo 'Daily diary of ' . $human->getName() . "\n";
  echo 'Ate: ' . $what . "\n";
  echo 'Eat time: ' . $eat_time . " seconds\n";
  echo 'Finished eating? ' . var_export($finished, true) . "\n";
  echo "Moved 2 feet\n";
  echo 'My day lasted: ' . strval($end - $start) . " seconds\n";
}

\HH\Asio\join(typical_day());
