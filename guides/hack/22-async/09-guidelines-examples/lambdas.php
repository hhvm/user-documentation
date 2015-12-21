<?hh

namespace Hack\UserDocumentation\Async\Guidelines\Examples\Lambdas;

// For asio-utilities that we installed via composer
require __DIR__ . "/../../../../vendor/hh_autoload.php";

async function fourth_root(num $n): Awaitable<float> {
  return sqrt(sqrt($n));
}

async function normal_call(): Awaitable<Vector<float>> {
  $nums = Vector {64, 81};
  return await \HH\Asio\vm(
    $nums,
    fun('\Hack\UserDocumentation\Async\Guidelines\Examples\Lambdas\fourth_root')
  );
}

async function closure_call(): Awaitable<Vector<float>> {
  $nums = Vector {64, 81};
  $froots = async function(num $n): Awaitable<float> {
    return sqrt(sqrt($n));
  };
  return await \HH\Asio\vm($nums, $froots);
}

async function lambda_call(): Awaitable<Vector<float>> {
  $nums = Vector {64, 81};
  return await \HH\Asio\vm($nums, async $num ==> sqrt(sqrt($num)));
}

async function use_lambdas(): Awaitable<void> {
  $nc = await normal_call();
  $cc = await closure_call();
  $lc = await lambda_call();
  var_dump($nc);
  var_dump($cc);
  var_dump($lc);
}

\HH\Asio\join(use_lambdas());
